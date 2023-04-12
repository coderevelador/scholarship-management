<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ApplyScholarshipController;
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
use App\Http\Controllers\GeneralSettings;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\ScholarshipListController;
use App\Http\Controllers\StudentEducationalProfileController;
use App\Models\AppliedScholarship;

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
    Route::get('/users/export/excel', [UsersController::class, 'export'])->name('users.export.excel');
    Route::get('/users/export/csv', [UsersController::class, 'exportCSV'])->name('users.export.csv');
    Route::get('/users/export/pdf', [UsersController::class, 'exportPDF'])->name('users.export.pdf');

    Route::resource('profile', UserProfileController::class);
    Route::resource('school', SchoolController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('course', CourseController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('scholarship-list', ScholarshipListController::class);
    Route::get('/scholarship-list/disable/{id}', [ScholarshipListController::class, 'disableStudentList'])->name('disable.studentlist');

    // Individual scholarship export
    Route::get('/scholarship-list/{id}/export/excel', [ScholarshipListController::class, 'exportExcelSingle'])->name('scholarshiplistsingle.export.excel');
    Route::get('/scholarship-list/{id}/export/csv', [ScholarshipListController::class, 'exportCSVSingle'])->name('scholarshiplistsingle.export.csv');
    Route::get('/scholarship-list/{id}/export/pdf', [ScholarshipListController::class, 'exportPDFSingle'])->name('scholarshiplistsingle.export.pdf');


    Route::resource('students', StudentsController::class);
    Route::get('/students/export/excel', [StudentsController::class, 'exportExcel'])->name('students.export.excel');
    Route::get('/students/export/csv', [StudentsController::class, 'exportCSV'])->name('students.export.csv');
    Route::get('/students/export/pdf', [StudentsController::class, 'exportPDF'])->name('students.export.pdf');

    Route::resource('academic-year', AcademicYearController::class);
    Route::resource('eligibility', EligibilityCheckController::class);

    // students section

    Route::get('/educational-details', [StudentEducationalProfileController::class, 'index'])->name('student.education');
    Route::get('/educational-details/add', [StudentEducationalProfileController::class, 'add'])->name('student.education.add');
    Route::get('/educational-details/edit/{id}', [StudentEducationalProfileController::class, 'edit'])->name('student.education.edit');
    Route::post('/educational-details/store', [StudentEducationalProfileController::class, 'store'])->name('student.education.store');
    Route::post('/educational-details/update/{id}', [StudentEducationalProfileController::class, 'update'])->name('student.education.update');

    Route::resource('apply-scholarship', ApplyScholarshipController::class);
    Route::get('/apply-scholarship/{id}/apply', [ApplyScholarshipController::class, 'applyScholarship'])->name('apply.scholarship');
    Route::post('/apply-scholarship/{id}/apply/store', [ApplyScholarshipController::class, 'storeAppliedScholarship'])->name('apply.store.scholarship');
    Route::get('/apply-scholarship/{id}/applied/status', [ApplyScholarshipController::class, 'statusAppliedScholarship'])->name('applied.status.scholarship');
    Route::get('/apply-scholarship/eligibility-checking/income', [ApplyScholarshipController::class, 'eligibilityIncome'])->name('eligibility.income');
    Route::get('/apply-scholarship/eligibility-checking/mark-percentage', [ApplyScholarshipController::class, 'MarkPercentage'])->name('eligibility.mark-percentage');

    Route::get('/applied-scholarship/all', [ApplyScholarshipController::class, 'AppliedScholarshipAll'])->name('apply.scholarship.all');
    Route::post('/applied-scholarship/filter', [ApplyScholarshipController::class, 'AppliedScholarshipFilter'])->name('apply.scholarship.filter');

    // All scholarship export
    Route::get('/applied-scholarship/export/excel', [ApplyScholarshipController::class, 'exportExcelAll'])->name('scholarshiplistall.export.excel');
    Route::get('/applied-scholarship/export/csv', [ApplyScholarshipController::class, 'exportCSVAll'])->name('scholarshiplistall.export.csv');
    Route::get('/applied-scholarship/export/pdf', [ApplyScholarshipController::class, 'exportPDFAll'])->name('scholarshiplistall.export.pdf');


    //    General Settings
    Route::resource('general-settings', GeneralSettingsController::class);
    Route::post('/general-settings/update-details', [GeneralSettingsController::class,'UpdateDetails'])->name('general.update.details');
});

// Guest

Route::group(['middleware' => 'guest'], function () {

    Route::resource('student-registration', StudentRegistration::class);
});
