<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\AuthController;

Route::domain('{account}.' . env('MAIN_DOMAIN', 'bisite.web.id'))->group(function () {
    Route::get('{any?}', function ($account, $any = 'index.html') {
        if (in_array($account, ['www', 'admin', 'api', 'mail', 'cpanel'])) {
            return redirect()->to(env('APP_URL') . '/' . $any);
        }

        $project = \App\Models\Project::where('subdomain', $account)
            ->where('is_published', true)
            ->first();

        if (!$project) {
            abort(404, 'Website tidak ditemukan atau belum dipublish.');
        }

        $userId = $project->user_id;
        if (empty($any) || $any == '/') {
            $any = 'index.html';
        }

        $path = storage_path("app/public/users/{$userId}/projects/{$project->id}/{$any}");

        if (!file_exists($path)) {
            abort(404);
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $mimeType = match($extension) {
            'css' => 'text/css',
            'js' => 'application/javascript',
            'svg' => 'image/svg+xml',
            'html', 'htm' => 'text/html',
            default => \Illuminate\Support\Facades\File::mimeType($path)
        };

        return response()->file($path, [
            'Content-Type' => $mimeType
        ]);
    })->where('any', '.*');
});

Route::get('/', [User\DashboardController::class, 'index'])->name('user.home');
Route::get('/templates', [User\DashboardController::class, 'templates'])->name('user.templates');
Route::get('/template/{template}/preview', [User\DashboardController::class, 'previewTemplate'])->name('template.preview')->middleware('signed');
Route::get('/help', function () { return view('user.pages.help-center'); })->name('user.help');
Route::get('/terms', function () { return view('user.pages.terms'); })->name('user.terms');
Route::get('/privacy', function () { return view('user.pages.privacy'); })->name('user.privacy');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.post');
    Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirect'])->name('socialite.redirect');
    Route::get('/auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'callback'])->name('socialite.callback');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user', [Admin\DashboardController::class, 'user'])->name('user');
    Route::post('/user/store', [Admin\DashboardController::class, 'storeUser'])->name('user.store');
    Route::put('/user/update/{id}', [Admin\DashboardController::class, 'updateUser'])->name('user.update');
    Route::delete('/user/delete/{id}', [Admin\DashboardController::class, 'deleteUser'])->name('user.delete');

    Route::resource('templates', Admin\TemplateController::class)->except(['show']);
    Route::patch('templates/{template}/toggle', [Admin\TemplateController::class, 'toggle'])->name('templates.toggle');

    Route::get('categories', [Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [User\DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [User\DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [User\DashboardController::class, 'updateProfile'])->name('profile.update');

    Route::get('/editor/{project}', [User\EditorController::class, 'show'])->name('editor');
    Route::get('/editor/{project}/load', [User\EditorController::class, 'load'])->name('editor.load');
    Route::post('/editor/{project}/save', [User\EditorController::class, 'save'])->name('editor.save');
    Route::post('/editor/{project}/upload-image', [User\EditorController::class, 'uploadImage'])->name('editor.upload-image');
    Route::get('/preview/{project}', [User\EditorController::class, 'preview'])->name('preview');
    Route::get('/download/{project}', [User\EditorController::class, 'download'])->name('download');
    Route::post('/template/{template}/project', [User\EditorController::class, 'createProject'])->name('project.create');
    Route::delete('/project/{project}', [User\EditorController::class, 'destroyProject'])->name('project.destroy');
    Route::post('/project/{project}/reset', [User\EditorController::class, 'resetProject'])->name('project.reset');
    Route::post('/project/{project}/publish', [User\EditorController::class, 'publishProject'])->name('project.publish');
    Route::post('/project/{project}/unpublish', [User\EditorController::class, 'unpublishProject'])->name('project.unpublish');
});


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});