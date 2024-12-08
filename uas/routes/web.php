<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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


