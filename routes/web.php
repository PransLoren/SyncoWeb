<?php

use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\teacherListController;
use App\Http\Controllers\studentListController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\taskController;
use App\Http\Controllers\ProjectController;
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


Route::get('/',[WebAuthController::class,'login']);
Route::get('logout',[WebAuthController::class,'logout']);
Route::get('forgot-password',[WebAuthController::class,'forgotpassword']);
Route::get('reset/{token}',[WebAuthController::class,'reset']);

Route::post('login',[WebAuthController::class,'Authlogin'])->name('login');
Route::post('forgot-password',[WebAuthController::class,'PostForgotPassword']);
Route::post('reset/{token}',[WebAuthController::class,'PostReset']);


Route::get('/admin/dashboard', function () {
    return view('Admin.admindash');
});


Route::group(['middleware' => 'admin'],function(){

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/admin/admin/list',[AdminController::class,'list']);

    //teacher
    Route::get('/admin/teacher/list',[teacherListController::class,'teacherList'])->name('teacher.list');
    Route::get('/admin/teacher/add',[teacherListController::class,'add']);
    Route::get('/admin/teacher/edit/{id}',[teacherListController::class,'edit']);   
    Route::get('/admin/teacher/delete/{id}',[teacherListController::class,'delete']);     
    Route::post('/admin/teacher/edit/{id}',[teacherListController::class,'update']);    
    Route::post('/admin/teacher/add',[teacherListController::class,'insert'])->name('insert');

    //student
    Route::get('/admin/student/list',[studentListController::class,'studentList'])->name('student.list');
    Route::get('/admin/student/add',[studentListController::class,'add']);
    Route::get('/admin/student/edit/{id}',[studentListController::class,'edit']);   
    Route::get('/admin/student/delete/{id}',[studentListController::class,'delete']);     
    Route::post('/admin/student/edit/{id}',[studentListController::class,'update']);    
    Route::post('/admin/student/add',[studentListController::class,'insert'])->name('insert');

    //subject
    Route::get('/admin/subject/list',[SubjectController::class,'subjectList']);
    Route::get('/admin/subject/add',[SubjectController::class,'add']);
    Route::get('/admin/subject/edit/{id}',[SubjectController::class,'edit']);   
    Route::get('/admin/subject/delete/{id}',[SubjectController::class,'delete']);     
    Route::post('/admin/subject/edit/{id}',[SubjectController::class,'update']);    
    Route::post('/admin/subject/add',[SubjectController::class,'insert'])->name('insert');

    //project
    Route::get('admin/project/list', [ProjectController::class, 'project']);
    Route::get('admin/project/project/add', [ProjectController::class, 'add']);
    Route::post('admin/ajax_get_subject', [ProjectController::class, 'ajax_get_subject']);
    Route::post('admin/project/project/add', [ProjectController::class, 'insert']);
    Route::get('admin/project/project/edit/{id}', [ProjectController::class, 'edit']);
    Route::post('admin/project/project/edit/{id}', [ProjectController::class, 'update']);

    Route::post('admin/project/project/delete/{id}', [ProjectController::class, 'delete']);
});

Route::group(['middleware' => 'manager'],function(){

    Route::get('/manager/manager/add',[ManagerController::class,'add']);
    Route::get('/manager/manager/list',[ManagerController::class,'managerlist']);
    Route::get('/manager/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/manager/manager/edit/{id}',[ManagerController::class,'edit']);   
    Route::get('/manager/manager/delete/{id}',[ManagerController::class,'delete']);     

    Route::post('/manager/manager/edit/{id}',[ManagerController::class,'update']);    
    Route::post('/manager/manager/add',[ManagerController::class,'insert'])->name('insert');

     //teacher
     Route::get('/manager/teacher/list',[teacherListController::class,'teacherLists'])->name('teacher.list');
     Route::get('/manager/teacher/add',[teacherListController::class,'addTeacher']);
     Route::get('/manager/teacher/edit/{id}',[teacherListController::class,'editTeacher']);   
     Route::get('/manager/teacher/delete/{id}',[teacherListController::class,'deleteTeacher']);     
     Route::post('/manager/teacher/edit/{id}',[teacherListController::class,'updateTeacher']);    
     Route::post('/manager/teacher/add',[teacherListController::class,'insertTeacher'])->name('insertTeacher');
 
     //student
     Route::get('/manager/student/list',[studentListController::class,'studentLists'])->name('student.list');
     Route::get('/manager/student/add',[studentListController::class,'addStudent']);
     Route::get('/manager/student/edit/{id}',[studentListController::class,'editStudent']);   
     Route::get('/manager/student/delete/{id}',[studentListController::class,'deleteStudent']);     
     Route::post('/manager/student/edit/{id}',[studentListController::class,'updateStudent']);    
     Route::post('/manager/student/add',[studentListController::class,'insertStudent'])->name('insertStudent');
 
     //class
     Route::get('/manager/subject/list',[SubjectController::class,'subjectLists']);
     Route::get('/manager/subject/add',[SubjectController::class,'addSubject']);
     Route::get('/manager/subject/edit/{id}',[SubjectController::class,'editSubject']);   
     Route::get('/manager/subject/delete/{id}',[SubjectController::class,'deleteSubject']);     
     Route::post('/manager/subject/edit/{id}',[SubjectController::class,'updateSubject']);    
     Route::post('/manager/subject/add',[SubjectController::class,'insertSubject'])->name('insertSubject');
});

Route::group(['middleware' => 'teacher'],function(){

    Route::get('/teacher/dashboard',[DashboardController::class,'dashboard']);

    Route::get('/teacher/student/list',[studentListController::class,'studentList']);
});

Route::group(['middleware' => 'student'],function(){

    Route::get('/student/dashboard',[DashboardController::class,'dashboard']);

    //task
    Route::get('/student/assigned',[taskController::class,'Assigned']);
    Route::get('/student/accept',[taskController::class,'Accept']);
    Route::get('/student/done',[taskController::class,'Done']);
});

