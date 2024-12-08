<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $roleId = auth()->user()->role_id;

    // Redirect based on the role_id
    if ($roleId == 1) {
        // Admin role
        return redirect()->route('admin.home');
    } elseif ($roleId == 2) {
        // User role
        return redirect()->route('user.home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function () {
        return view('admin.homepage_admin');
    })->name('home');

    Route::get('/components/show/{id}', [\App\Http\Controllers\ComponentController::class, 'show']
    )->name('components.show');

    Route::get('/calendar', function () {
        return view('admin.calendar_admin');
    })->name('calendar');

    Route::get('/todo', function () {
        return view('admin.todo_admin');
    })->name('todo');

    Route::get('/message', function () {
        return view('admin.message_admin');
    })->name('message');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/home', function () {
        return view('user.homepage_user');
    })->name('home');

    Route::get('/home/divisi/{id}', function ($id) {
        return view('components.show_divisi', compact('id'));
    })->name('components.show');

    Route::get('/calendar', function () {
        return view('user.calendar_user');
    })->name('calendar');

    Route::get('/todo', function () {
        return view('user.todo_user');
    })->name('todo');

    Route::get('/message', function () {
        return view('user.message_user');
    })->name('message');
});


require __DIR__.'/auth.php';
