<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

//  Web Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Route
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Include additional route files
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class);

    Route::patch(
        'tasks/{task}/toggle-complete',
        [TaskController::class, 'toggleComplete']
    )->name('tasks.toggleComplete');
});

// Settings Routes
require __DIR__.'/settings.php';
