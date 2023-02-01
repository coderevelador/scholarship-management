<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;

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

Route::get('/', [LoginController::class, 'index']);

Auth::routes();
Route::get('logout', [LogoutController::class, 'perform'])->name('logout.perform');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'permission']], function () {

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    /**
     * User Routes
     */

    Route::get('/users', [UsersController::class, 'index'])->name('all_users');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/index', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/show/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});
