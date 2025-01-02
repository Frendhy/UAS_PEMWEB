<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TaskCommentController;

Route::post('/tasks/{taskId}/comments', [TaskCommentController::class, 'store'])->name('tasks.comments.store');
Route::post('/tasks', [TaskController::class, 'store']); 
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::post('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
Route::get('/tasks/{taskId}', [TaskController::class, 'showTaskDetails']);

Route::get('/hmifpage', [HomeController::class, 'show'])->name('hmifpage');

Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
Route::resource('events', EventController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('change-password', [PasswordController::class, 'edit'])->name('password.change');
    Route::post('change-password', [PasswordController::class, 'update'])->name('password.change.store');
});

Route::get('/', function () {
    if (Auth::check()) {
        $roleId = auth()->user()->role_id;

        if ($roleId == 1) {
            return redirect()->route('admin.home');
        } elseif ($roleId == 2) {
            return redirect()->route('user.home');
        }
    }
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    if (Auth::check()) {
        $roleId = auth()->user()->role_id;

        if ($roleId == 1) {
            return redirect()->route('admin.home');
        } elseif ($roleId == 2) {
            return redirect()->route('user.home');
        }
    }
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    $roleId = auth()->user()->role_id;

    if ($roleId == 1) {
        return redirect()->route('admin.home');
    } elseif ($roleId == 2) {
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

    Route::get('/division', function () {
        return view('admin.division_admin');
    })->name('division');

    Route::get('/division', [TaskController::class, 'showDivisionsAdmin'])->name('division');

    Route::post('/tasks', [TaskController::class, 'store']); 

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


    Route::get('/division', function () {
        return view('user.division_user');
    })->name('division');

    Route::get('/division', [TaskController::class, 'showDivisionsUser'])->name('division');
    
    Route::get('/todo', [TaskController::class, 'userTodo'])->name('todo');

    Route::get('/message', function () {
        return view('user.message_user');
    })->name('message');
});

Route::post('/messages', [ChatController::class, 'store'])->middleware('auth');
Route::get('/messages', [ChatController::class, 'index'])->middleware('auth');


require __DIR__.'/auth.php';