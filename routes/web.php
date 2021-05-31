<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ResearchController;
use App\Http\Controllers\Frontend\AuthenticationController;
use App\Http\Controllers\Cms\AdminAuthenticationController;
use App\Http\Controllers\Cms\UserManagementController;
use App\Http\Controllers\Cms\HomeController as AdminHome;
use App\Http\Controllers\Cms\AdminUploadFile;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});


Route::namespace('Cms')->prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticationController::class, 'index']);
    Route::post('/login', [AdminAuthenticationController::class, 'loginData']);
    Route::get('/user-verification/{verificationToken}', [AdminAuthenticationController::class, 'userVerification']);
    Route::post('/user-verification/{verificationToken}', [AdminAuthenticationController::class, 'userVerificationData']);
    Route::get('/forgot-password', [AdminAuthenticationController::class, 'forgotPassword']);
    Route::post('/forgot-password', [AdminAuthenticationController::class, 'forgotPasswordData']);

    Route::get('/dashboard', [AdminHome::class, 'index']);
    Route::get('/logout', [AdminAuthenticationController::class, 'logout']);

    Route::get('/add-research-template', [AdminUploadFile::class, 'researchTemplate']);
    Route::post('/add-research-template', [AdminUploadFile::class, 'addResearchTemplate']);

    Route::get('/manage-users', [UserManagementController::class, 'index']);
    Route::get('/add-user', [UserManagementController::class, 'addUser']);
    Route::post('/add-user', [UserManagementController::class, 'addUserData']);
    Route::get('/update-user/{userId}',  [UserManagementController::class, 'updateUser']);
    Route::put('/update-user/{userId}', [UserManagementController::class, 'updateUserData']);
    Route::get('/user-detail/{userId}', [UserManagementController::class, 'getUserDetail']);
    Route::get('/block-user/{userId}', [UserManagementController::class, 'blockUser']);

    Route::get('/manage-roles', 'RoleController@index');
    Route::get('/add-role', 'RoleController@addRole');
    Route::post('/add-role', 'RoleController@addRoleData');
    Route::get('/update-role/{roleId}', 'RoleController@updateRole');
    Route::put('/update-role/{roleId}', 'RoleController@updateRoleData');
});

Route::namespace('Frontend')->group(function () {

    Route::prefix('student')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index']);

        Route::get('/research-project', [ResearchController::class, 'index']);
        Route::get('/research-project-download', [ResearchController::class, 'downloadTemplate']);
        Route::post('/research-project', [ResearchController::class, 'addData']);
    });

    Route::get('/login', [AuthenticationController::class, 'index']);
    Route::post('/login', [AuthenticationController::class, 'loginData']);
    Route::get('/signup', [AuthenticationController::class, 'registerUser']);
    Route::post('/signup', [AuthenticationController::class, 'registerUserData']);
    Route::get('/user-verification/{verificationToken}', [AuthenticationController::class, 'userVerification']);
    Route::get('/user-password-verification/{verificationToken}', [AuthenticationController::class, 'userPasswordVerification']);
    Route::post('/user-password-verification/{verificationToken}', [AuthenticationController::class, 'userPasswordVerificationData']);
    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword']);
    Route::post('/forgot-password', [AuthenticationController::class, 'forgotPasswordData']);
    Route::get('/logout', [AuthenticationController::class, 'logout']);
});