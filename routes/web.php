<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\allController;

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


Route::get('/', [allController::class, 'registration']);
Route::post('store-register', [allController::class, 'storeRegister']);
Route::get('login', [allController::class, 'login']);
Route::post('store-login', [allController::class, 'storeLogin']);

Route::middleware(['isLoggedIn'])->group(function () {

    Route::middleware(['isAdmin'])->group(function(){
        
        Route::get('admin-dashboard', [allController::class, 'adminDashboard']);
        
        // Create Course section
        Route::get('create-course', [allController::class, 'createCourse']);
        Route::post('store-course', [allController::class, 'storeCourse']);
        Route::get('courses', [allController::class, 'courses']);
        Route::post('update-course/{id}', [allController::class, 'updateCourse']);
        Route::get('delete-course/{id}', [allController::class, 'deleteCourse']);
        // End of Create course Section
        
        // Create Department Section
        Route::get('create-department', [allController::class, 'createDepartment']);
        Route::post('store-department', [allController::class, 'storeDepartment']);
        Route::get('departments', [allController::class, 'departments']);
        Route::post('update-department/{id}', [allController::class, 'updateDepartment']);
        Route::get('delete-department/{id}', [allController::class, 'deleteDepartment']);
        // End of create Department Section
        
        // Create Teacher Section 
        Route::get('create-teacher', [allController::class, 'createTeacher']);
        Route::post('store-teacher', [allController::class, 'storeTeacher']);
        Route::get('teachers', [allController::class, 'teachers']);
        Route::post('update-teacher/{id}', [allController::class, 'updateTeacher']);
        Route::get('delete-teacher/{id}', [allController::class, 'deleteTeacher']);
        // End of Create Teacher section
        
        // Session 
        Route::get('create-session', [allController::class, 'createSession']);
        Route::post('store-session', [allController::class, 'storeSession']);
        Route::get('delete-session/{id}', [allController::class, 'deleteSession']);
        Route::get('change-status/{id}', [allController::class, 'changeStatus']);
        // End Session

        // PreEnrollment
        Route::get('pre-enrollment', [allController::class, 'preEnrollment']);
        Route::get('generate-pdf', [allController::class, 'generatePdf']);
        Route::post('view-pdf', [allController::class, 'viewPdf']);
        Route::get('generate-excel', [allController::class, 'export']);
        // End of PreEnrollment

        Route::post('change-admin-password', [allController::class, 'changeAdminPassword']);
        
        Route::get('login-details', [allController::class, 'loginDetails']);

        Route::get('enrollment-details', [allController::class, 'enrollmentDetails']);
    });

    Route::middleware(['isStudent'])->group(function(){
        Route::get('student-dashboard', [allController::class, 'studentDashboard']);
        Route::post('update-personal-data', [allController::class, 'updatePersonalData']);

        Route::get('enrollment', [allController::class, 'enrollment']);
        Route::post('store-enrollment', [allController::class, 'storeEnrollment']);
        Route::get('pending-enrollment', [allController::class, 'pendingEnrollment']);
        Route::get('delete-enrollment/{id}', [allController::class, 'deleteEnrollment']);
        Route::get('remove-all-enrollment', [allController::class, 'deleteAllEnrollment']);
        
        Route::post('change-passwords', [allController::class, 'changeEncryptedPassword']);
    });
    
    Route::get('logout', [allController::class, 'logout']);
    
});
