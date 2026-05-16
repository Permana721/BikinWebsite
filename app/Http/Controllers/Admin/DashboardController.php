<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Template; 
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalUser = User::where('role', 'user')->count();
        $totalTemplate = Template::count(); 
        
        // Menghitung pendapatan berdasarkan tier user
        $proUsersCount = User::where('role', 'user')->where('tier', 'pro')->count();
        $eliteUsersCount = User::where('role', 'user')->where('tier', 'elite')->count();
        
        $totalRevenue = ($proUsersCount * 50000) + ($eliteUsersCount * 75000);

        // Menghitung jumlah website yang online
        $totalOnlineWebsites = Project::where('is_published', true)->whereNotNull('subdomain')->count();

        // Server-side search & pagination untuk "transaksi"
        $query = User::where('role', 'user')->whereIn('tier', ['pro', 'elite']);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        $latestTransactions = $query->orderBy('updated_at', 'desc')->paginate(5)->withQueryString();

        return view('admin.dashboard', compact('totalUser', 'totalTemplate', 'totalRevenue', 'totalOnlineWebsites', 'latestTransactions'));
    }




    public function user(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(5)->withQueryString();
        
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'tier' => 'required|in:lite,pro,elite',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'tier' => $request->tier,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengedit akun sendiri.');
        }

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'role', 'tier', 'status', 'status_reason']));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.user')->with('success', 'User berhasil diperbarui');
    }

    public function deleteUser($id)
    {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    public function hostedWebsites(Request $request)
    {
        $query = Project::with(['user', 'template'])->where('is_published', true)->whereNotNull('subdomain');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('subdomain', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($uq) use ($request) {
                      $uq->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('template', function ($tq) use ($request) {
                      $tq->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $websites = $query->latest('updated_at')->paginate(10)->withQueryString();

        return view('admin.hosted-websites.index', compact('websites'));
    }
}