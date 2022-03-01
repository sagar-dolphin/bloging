<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

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

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::namespace('Auth')->group(function(){
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [LoginController::class, 'login']);
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });

    Route::middleware('auth:admin')->group(function(){
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('users/store', [UserController::class, 'store']);
        Route::get('users/edit/{id}', [UserController::class, 'edit']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
