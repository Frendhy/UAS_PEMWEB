<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
});


Route::resource('event', EventController::class);
Route::get('events/list', [EventController::class, 'listEvent'])->name('event.list');


Route::middleware(['auth'])->group(function () {
    // Show the change password form
    Route::get('change-password', [PasswordController::class, 'edit'])->name('password.change');
    
    // Handle the change password form submission
    Route::post('change-password', [PasswordController::class, 'update'])->name('password.change.store');
});


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

Route::middleware('auth')->post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function () {
        return view('admin.homepage_admin');
    })->name('home');

    Route::get('/components/show/{id}', [\App\Http\Controllers\ComponentController::class, 'show']
    )->name('components.show');

    Route::get('/calendar', function () {
        return view('event');
    })->name('calendar');

    Route::get('/todo', [TaskController::class, 'adminTodo'])->name('todo');

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
        return view('event');
    })->name('calendar');

    Route::get('/todo', [TaskController::class, 'userTodo'])->name('todo');

    Route::get('/message', function () {
        return view('user.message_user');
    })->name('message');
});


require __DIR__.'/auth.php';
