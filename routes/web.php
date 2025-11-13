<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompaniController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return view('errors.404');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    //EMPLOYEE
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/addemployee', [EmployeeController::class, 'create'])->name('addemployee');
    Route::post('/postemployee', [EmployeeController::class, 'store'])->name('postemployee');
    Route::delete('/employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('delemployee');

    //COMPANY
    Route::get('/company', [CompaniController::class, 'index'])->name('company');
    Route::get('/addcompany', [CompaniController::class, 'create'])->name('addcompany');
    Route::post('/postcompany', [CompaniController::class, 'store'])->name('postcompany');
    Route::delete('/company/{id}/delete', [CompaniController::class, 'destroy'])->name('delcompany');

    //BRANCH
    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::get('/addbranch', [BranchController::class, 'create'])->name('addbranch');
    Route::post('/postbranch', [BranchController::class, 'store'])->name('postbranch');
    Route::get('/editbranch/{id}', [BranchController::class, 'edit'])->name('editbranch');
    Route::put('/branch/{id}/update', [BranchController::class, 'update'])->name('updatebranch');
    Route::delete('/branch/{id}/delete', [BranchController::class, 'destroy'])->name('delbranch');

    //ATTENDANCE
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/addattendance', [AttendanceController::class, 'create'])->name('addattendance');
    Route::post('/postattendance', [AttendanceController::class, 'store'])->name('postattendance');
    Route::get('/editattendance/{id}', [AttendanceController::class, 'edit'])->name('editattendance');
    Route::put('/attendance/{id}/update', [AttendanceController::class, 'update'])->name('updateattendance');
    Route::delete('/attendance/{id}/delete', [AttendanceController::class, 'destroy'])->name('delattendance');
});
