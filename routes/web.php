<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('website')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/research', 'ResearchController@index');
    Route::get('/our-professors', 'ProfessorController@index');
    Route::get('/about-us', 'AboutController@index');
    Route::get('/our-news', 'NewsController@index');
    Route::get('/contact', 'ContactController@index');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/student', function () {
    return redirect('/login');
});

Route::namespace('Cms')->prefix('admin')->group(function () {
    Route::middleware('UnAuthentic')->group(function () {
        Route::get('/login', 'AuthenticationController@index');
        Route::post('/login', 'AuthenticationController@loginData');
        Route::get('/user-verification/{verificationToken}', 'AuthenticationController@userVerification');
        Route::post('/user-verification/{verificationToken}', 'AuthenticationController@userVerificationData');
        Route::get('/forgot-password', 'AuthenticationController@forgotPassword');
        Route::post('/forgot-password', 'AuthenticationController@forgotPasswordData');
    });

    Route::middleware(['AuthenticAdmin', 'not_student'])->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::post('/manage-profile', 'ProfileController@updateProfile');
        Route::get('/notifications', 'NotificationController@index');
        Route::get('/delete-notification/{notificationId}', 'NotificationController@deleteNotification');
        Route::get('/notification-detail/{notificationId}', 'NotificationController@detailNotification');

        Route::get('/manage-users', 'UserManagementController@index');
        Route::get('/add-user', 'UserManagementController@addUser');
        Route::post('/add-user', 'UserManagementController@addUserData');
        Route::get('/update-user/{userId}', 'UserManagementController@updateUser');
        Route::put('/update-user/{userId}', 'UserManagementController@updateUserData');
        Route::get('/user-detail/{userId}', 'UserManagementController@getUserDetail');
        Route::get('/block-user/{userId}', 'UserManagementController@blockUser');

        Route::get('/manage-roles', 'RoleController@index');
        Route::get('/add-role', 'RoleController@addRole');
        Route::post('/add-role', 'RoleController@addRoleData');
        Route::get('/update-role/{roleId}', 'RoleController@updateRole');
        Route::put('/update-role/{roleId}', 'RoleController@updateRoleData');
        Route::get('/delete-role/{roleId}', 'RoleController@deleteRole');

        Route::get('/upload-samples', 'UploadSampleController@index');
        Route::get('/delete-upload-sample/{uploadId}', 'UploadSampleController@deleteUpload');

        Route::namespace('Student')->prefix('student')->group(function () {
            Route::get('/research-projects', 'ResearchProjectController@index');
            Route::get('/add-research-project', 'ResearchProjectController@addResearch');
            Route::post('/add-research-project', 'ResearchProjectController@addResearchData');
            Route::get('/update-research-project/{researchId}', 'ResearchProjectController@updateResearch');
            Route::post('/update-research-project/{researchId}', 'ResearchProjectController@updateResearchData');
            Route::get('/research-project-detail/{researchId}', 'ResearchProjectController@researchDetail');
            Route::get('/research-project-change-status/{researchId}/{status}', 'ResearchProjectController@changeStatus');
            Route::get('/add-research-project-template', 'ResearchProjectController@uploadResearchTemplate');
            Route::post('/add-research-project-template', 'ResearchProjectController@uploadResearchTemplateData');
        });

    });
});


Route::namespace('FrontEnd')->group(function () {
    Route::middleware('UnAuthentic')->group(function () {
        Route::get('/login', 'AuthenticationController@index');
        Route::post('/login', 'AuthenticationController@loginData');
        Route::get('/register', 'AuthenticationController@registerUser');
        Route::post('/register', 'AuthenticationController@registerUserData');
        Route::get('/new-student-verification/{verificationToken}', 'AuthenticationController@userVerification');
        Route::get('/student-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerification');
        Route::post('/student-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerificationData');
        Route::get('/forgot-password', 'AuthenticationController@forgotPassword');
        Route::post('/forgot-password', 'AuthenticationController@forgotPasswordData');
    });

    Route::middleware(['AuthenticStudent', 'not_admin'])->prefix('student')->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::post('/manage-profile', 'ProfileController@updateProfile');
        Route::get('/notifications', 'NotificationController@index');
        Route::get('/delete-notification/{notificationId}', 'NotificationController@deleteNotification');
        Route::get('/notification-detail/{notificationId}', 'NotificationController@detailNotification');

        Route::namespace('Student')->group(function () {
            Route::get('/research-projects', 'ResearchProjectController@index');
            Route::get('/add-research-project', 'ResearchProjectController@addStudentResearch');
            Route::post('/add-research-project', 'ResearchProjectController@addStudentResearchData');
            Route::get('/research-project-template', 'ResearchProjectController@downloadTemplate');
            Route::get('/notification-detail/{notificationId}', 'ResearchProjectController@detailNotification');
        });
    });
});
