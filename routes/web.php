<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
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

    Route::middleware(['auth:admin', 'role:writer|editor|publisher'])->group(function(){
        Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
        Route::post('posts/store', [PostController::class, 'store']);
    }); 
    
    Route::middleware(['auth:admin', 'role:super-admin'])->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('roles/show', [RoleController::class, 'getRoles'])->name('admin.roles.show');
        Route::post('users/store', [UserController::class, 'store']);
        Route::get('users/edit/{id}', [UserController::class, 'edit']);
        Route::post('users/update', [UserController::class, 'update']);
        Route::get('users/destroy/{id}', [UserController::class, 'destroy']);
        Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::post('roles/store', [RoleController::class, 'store']);
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('categories/store', [CategoryController::class, 'store']);
        Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('categories/update', [CategoryController::class, 'update']);
        Route::get('categories/destroy/{id}', [CategoryController::class, 'destroy']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
