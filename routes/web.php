<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;

// Route::get('/', function () {
//   return Inertia::render('Welcome');
// })->name('home');

Route::get('/', [HomeController::class, 'index']);
Route::get('/registrace', [AuthController::class, 'create'])->name('auth.registrace.formular');
Route::post('/registrace', [AuthController::class, 'store'])->name('auth.registrace');
Route::get('/prihlaseni', [AuthController::class, 'login'])->name('login');
Route::post('/prihlaseni', [AuthController::class, 'prihlaseni'])->name('auth.prihlaseni');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
  Route::get('/ukoly', [TaskController::class, 'index'])->name('tasks.index');
  Route::post('/ukoly', [TaskController::class, 'store'])->name('tasks.store');
  Route::get('/ukoly/vytvorit', [TaskController::class, 'create'])->name('tasks.create');
  Route::get('/ukoly/hotove', [TaskController::class, 'filtrHotove'])->name('tasks.hotove');
  Route::get('/ukoly/nehotove', [TaskController::class, 'filtrNehotove'])->name('tasks.nehotove');
  // Route::get('/{id}', [TaskController::class, 'show'])->name('tasks.show');
  Route::get('/ukoly/{id}/upravit', [TaskController::class, 'edit'])->name('tasks.edit');
  Route::put('/ukoly/{id}', [TaskController::class, 'update'])->name('tasks.update');
  Route::delete('/ukoly/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

