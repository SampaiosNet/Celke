<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/index-users', [UserController::class, 'index'])->name('users.index');
Route::get('/show-users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/create-users', [UserController::class, 'create'])->name('users.create');
Route::post('/store-users', [UserController::class, 'store'])->name('users.store');
Route::get('/edit-users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/update-users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/editPassword-users/{user}', [UserController::class, 'editPassword'])->name('users.editPassword');
Route::put('/updatePassword-users/{user}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
Route::delete('/destroy-users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/pdfUser-users/{user}', [UserController::class, 'pdfUser'])->name('users.pdfUser');
