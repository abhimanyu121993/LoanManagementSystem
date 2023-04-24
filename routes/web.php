<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\HasPermissionController;
use App\Http\Controllers\admin\LoantypeController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\text;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin\includes\master');
});
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login-store', [AuthController::class, 'login'])->name('loginStore');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/attendance', [AuthController::class, 'attendance'])->name('attendance');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/role', [RoleController::class, 'role'])->name('role');
    Route::post('/role-store', [RoleController::class, 'roleStore'])->name('roleStore');
    Route::get('/role-edit/{id}', [RoleController::class, 'roleEdit'])->name('roleEdit');
    Route::post('/role-update/{id}', [RoleController::class, 'roleUpdate'])->name('roleUpdate');
    Route::get('/role-delete/{id}', [RoleController::class, 'roleDelete'])->name('roleDelete');


    Route::get('/permission', [PermissionController::class, 'permission'])->name('permission');
    Route::post('/permission-store', [PermissionController::class, 'permissionStore'])->name('permissionStore');
    Route::get('/permission-edit/{id}', [PermissionController::class, 'permissionEdit'])->name('permissionEdit');
    Route::post('/permission-update/{id}', [PermissionController::class, 'permissionUpdate'])->name('permissionUpdate');
    Route::get('/permission-delete/{id}', [PermissionController::class, 'permissionDelete'])->name('permissionDelete');

    Route::get('/has-permission', [HasPermissionController::class, 'hasPermission'])->name('hasPermission');
    Route::get('/role-permission-fatch', [HasPermissionController::class, 'rolePermissionFatch'])->name('rolePermissionFatch');
    Route::post('/assing-permission', [HasPermissionController::class, 'assingPermission'])->name('assingPermission');

    Route::get('/user-register', [UserController::class, 'userRegister'])->name('userRegister');
    Route::post('/user-store', [UserController::class, 'userStore'])->name('userStore');
    Route::get('/user-edit/{id}', [UserController::class, 'userEdit'])->name('userEdit');
    Route::post('/user-update/{id}', [UserController::class, 'userUpdate'])->name('userUpdate');
    Route::get('/user-delete/{id}', [UserController::class, 'userDelete'])->name('userDelete');
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::get('/change-password/{id}', [UserController::class, 'password'])->name('password');
    Route::post('/password-update/{id}', [UserController::class, 'passwordUpdate'])->name('passwordUpdate');
    Route::resource('/loan-type',LoantypeController::class);
    Route::get('loan-type-status/{id}',[LoantypeController::class,'status'])->name('status');
});

