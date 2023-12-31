<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;

Route::get('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout']);
Route::post('login',[AuthController::class,'AuthLogin']);
Route::get('forgot-password',[AuthController::class,'forgotPassword']);
Route::post('forgot-password',[AuthController::class,'postForgotPassword']);
Route::get('reset/{token}',[AuthController::class,'reset']);
Route::post('reset/{token}',[AuthController::class,'postReset']);



Route::group(['middleware'=>'admin'],function(){

    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('admin/admin/list',[AdminController::class,'list']);
    Route::get('admin/admin/add',[AdminController::class,'add']);
    Route::post('admin/admin/add',[AdminController::class,'insert']);
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit']);
    Route::post('admin/admin/edit/{id}',[AdminController::class,'update']);
    Route::get('admin/admin/delete/{id}',[AdminController::class,'delete']);

    //class route
    Route::get('admin/class/list',[ClassController::class,'list']);
    Route::get('admin/class/add',[ClassController::class,'add']);
    Route::post('admin/class/add',[AdminController::class,'insert']);
    Route::get('admin/class/edit/{id}',[ClassController::class,'edit']);
    Route::post('admin/class/edit/{id}',[ClassController::class,'update']);
    Route::get('admin/class/delete/{id}',[ClassController::class,'delete']);

    //subject routes
    Route::get('admin/subject/list',[SubjectController::class,'list']);
    Route::get('admin/subject/add',[SubjectController::class,'add']);
    Route::post('admin/subject/add',[SubjectController::class,'insert']);
    Route::get('admin/subject/edit/{id}',[SubjectController::class,'edit']);
    Route::post('admin/subject/edit/{id}',[SubjectController::class,'update']);
    Route::get('admin/subject/delete/{id}',[SubjectController::class,'delete']);

    //assign subject routes
    Route::get('admin/assign_subject/list',[ClassSubjectController::class,'list']);
    Route::get('admin/assign_subject/add',[ClassSubjectController::class,'add']);
    Route::post('admin/assign_subject/add',[ClassSubjectController::class,'insert']);
    Route::get('admin/assign_subject/edit/{id}',[ClassSubjectController::class,'edit']);
    Route::post('admin/assign_subject/edit',[ClassSubjectController::class,'update']);
    Route::get('admin/assign_subject/edit_single/{id}',[ClassSubjectController::class,'editSingle']);
    Route::post('admin/assign_subject/edit_single',[ClassSubjectController::class,'updateSingle']);
    Route::get('admin/assign_subject/delete/{id}',[ClassSubjectController::class,'delete']);

    //change password
    Route::get('admin/change_password',[UserController::class,'changePassword']);
    Route::post('admin/change_password',[UserController::class,'updateChangePassword']);


});

Route::group(['middleware'=>'teacher'],function(){
    Route::get('teacher/dashboard',[DashboardController::class,'dashboard']);

    //change password
    Route::get('teacher/change_password',[UserController::class,'changePassword']);
    Route::post('teacher/change_password',[UserController::class,'updateChangePassword']);
});

Route::group(['middleware'=>'student'],function(){
    Route::get('student/dashboard',[DashboardController::class,'dashboard']);

    //change password
    Route::get('student/change_password',[UserController::class,'changePassword']);
    Route::post('student/change_password',[UserController::class,'updateChangePassword']);
});

Route::group(['middleware'=>'parent'],function(){
    Route::get('parent/dashboard',[DashboardController::class,'dashboard']);

    //change password
    Route::get('parent/change_password',[UserController::class,'changePassword']);
    Route::post('parent/change_password',[UserController::class,'updateChangePassword']);
});


