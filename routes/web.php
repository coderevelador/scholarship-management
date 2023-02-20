<?php

use App\Http\Controllers\AcademicYearController;
use App\Models\Division;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\students\StudentsController;

use App\Http\Controllers\students\StudentRegistration;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\EligibilityCheckController;
use App\Http\Controllers\ScholarshipListController;

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

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



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


    Route::resource('profile', UserProfileController::class);
    Route::resource('school', SchoolController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('course', CourseController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('students', StudentsController::class);
    Route::resource('scholarship-list', ScholarshipListController::class);
    Route::get('/scholarship-list/disable/{id}', [ScholarshipListController::class, 'disableStudentList'])->name('disable.studentlist');

    Route::resource('academic-year', AcademicYearController::class);
    Route::resource('eligibility', EligibilityCheckController::class);
});

// Guest

Route::group(['middleware' => 'guest'], function () {

    Route::resource('student-registration', StudentRegistration::class);
});
