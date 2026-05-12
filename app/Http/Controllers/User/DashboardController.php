<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template; 
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $templates = Template::with('category')->where('is_active', true)->latest()->take(3)->get();
        return view('user.home', compact('categories', 'templates'));
    }

    public function dashboard()
    {
        $templates = Template::with('category')->where('is_active', true)->latest()->get();
        $projects = \App\Models\Project::with('template')
                      ->where('user_id', Auth::id())
                      ->whereColumn('updated_at', '>', 'created_at')
                      ->latest()
                      ->get();
                      
        return view('user.dashboard', compact('templates', 'projects'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
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

    public function templates()
    {
        $categories = Category::all();
        $templates = Template::with('category')->where('is_active', true)->latest()->get();
        return view('user.templates.index', compact('templates', 'categories'));
    }

    public function previewTemplate(\App\Models\Template $template)
    {
        return view('user.templates.preview', compact('template'));
    }
}