<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
   return view('admin.dashboard');
})->name('dashboard');

//Gestión dee Roles
Route::resource('roles', RoleController::class);

// Gestión de Usuarios
Route::resource('users', UserController::class);
