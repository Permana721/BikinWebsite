<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        $orders = [
            (object)[
                'id' => 'INV-202604-001',
                'template_name' => 'Savory Bistro',
                'date' => '24 April 2026',
                'total' => 'Rp 150.000',
                'status' => 'Berhasil' 
            ],
            (object)[
                'id' => 'INV-202603-089',
                'template_name' => 'Aesthetic Wear',
                'date' => '10 Maret 2026',
                'total' => 'Rp 120.000',
                'status' => 'Berhasil'
            ]
        ];

        return view('user.profile', compact('user', 'orders'));
    }

    public function updateProfile(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], 
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
