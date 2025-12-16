<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

// Route::get('/', function () {
//   return Inertia::render('Welcome');
// })->name('home');

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/vytvorit', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/hotove', [TaskController::class, 'filtrHotove'])->name('tasks.hotove');
Route::get('/nehotove', [TaskController::class, 'filtrNehotove'])->name('tasks.nehotove');
// Route::get('/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/{id}/upravit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
