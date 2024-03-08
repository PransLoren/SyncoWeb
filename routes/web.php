<?php

use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\studentListController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NotificationController;
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


Route::get('/',[WebAuthController::class,'loginuser'])->name('loginuser');
Route::get('/registration',[WebAuthController::class,'registration'])->name('registration');
Route::get('logout',[WebAuthController::class,'logout']);
Route::get('forgot-password',[WebAuthController::class,'forgotpassword']);
Route::get('reset/{token}',[WebAuthController::class,'reset']);
Route::get('/student/profile', [WebAuthController::class, 'profile'])->name('student.profile');
Route::post('/profile/update', [WebAuthController::class, 'update'])->name('profile.update');


Route::post('login',[WebAuthController::class,'Authlogin'])->name('login');
Route::post('register', [WebAuthController::class, 'register'])->name('register');
Route::post('forgot-password',[WebAuthController::class,'PostForgotPassword']);
Route::post('reset/{token}',[WebAuthController::class,'PostReset']);

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/admin/dashboard', function () {
    return view('Admin.admindash');
});

Route::group(['middleware' => 'admin'],function(){

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/admin/admin/list',[AdminController::class,'list']);

    //student
    Route::get('/admin/student/list',[studentListController::class,'studentList'])->name('student.list');
    Route::get('/admin/student/add',[studentListController::class,'add']);
    Route::get('/admin/student/edit/{id}',[studentListController::class,'edit']);   
    Route::get('/admin/student/delete/{id}',[studentListController::class,'delete']);     
    Route::post('/admin/student/edit/{id}',[studentListController::class,'update']);    
    Route::post('/admin/student/add',[studentListController::class,'insert'])->name('insert');


    //project
    Route::get('admin/project/list', [ProjectController::class, 'project']);
    Route::get('admin/project/project/add', [ProjectController::class, 'add']);
    Route::post('admin/ajax_get_subject', [ProjectController::class, 'ajax_get_subject']);
    Route::post('admin/project/project/add', [ProjectController::class, 'insert']);
    Route::get('admin/project/project/edit/{id}', [ProjectController::class, 'edit']);
    Route::post('admin/project/project/edit/{id}', [ProjectController::class, 'update']);

    Route::post('admin/project/project/delete/{id}', [ProjectController::class, 'delete']);
});



Route::group(['middleware' => 'student'],function(){

    Route::get('/student/dashboard',[DashboardController::class,'dashboard'])->name('userdashboard');

    Route::post('student/project/project/submit/{id}', [ProjectController::class, 'submit']);

     //project
     Route::get('student/project/list', [ProjectController::class, 'project']);
     Route::get('student/project/project/add', [ProjectController::class, 'add']);
     Route::post('student/ajax_get_subject', [ProjectController::class, 'ajax_get_subject']);
     Route::post('student/project/project/add', [ProjectController::class, 'insert']);
     Route::get('student/project/project/edit/{id}', [ProjectController::class, 'edit']);
     Route::post('student/project/project/edit/{id}', [ProjectController::class, 'update']);
     Route::post('/invite/{projectId}', [ProjectController::class, 'invite'])->name('invite');   
     Route::post('/task/submit/{id}', [ProjectController::class, 'tasksubmit'])->name('task.submit');
     Route::get('/task/view', [ProjectController::class, 'viewTask'])->name('task.view');
     Route::post('student/project/project/delete/{id}', [ProjectController::class, 'delete']);
});

