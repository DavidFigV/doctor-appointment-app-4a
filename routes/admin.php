<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
   return view('admin.dashboard');
})->name('dashboard');

//Gestión dee Roles
Route::resource('roles', RoleController::class);

// Gestión de Usuarios
Route::resource('users', UserController::class);

// Gestión de Pacientes
Route::resource('patients', PatientController::class);
