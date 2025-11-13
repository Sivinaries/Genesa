<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompaniController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
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
    Route::get('/setting', [PageController::class, 'setting'])->name('setting');

    //COMPANY
    Route::get('/company', [CompaniController::class, 'index'])->name('company');
    Route::get('/addcompany', [CompaniController::class, 'create'])->name('addcompany');
    Route::post('/postcompany', [CompaniController::class, 'store'])->name('postcompany');
    Route::delete('/company/{id}/delete', [CompaniController::class, 'destroy'])->name('delcompany');

    //BRANCH
    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::post('/postbranch', [BranchController::class, 'store'])->name('postbranch');
    Route::put('/branch/{id}/update', [BranchController::class, 'update'])->name('updatebranch');
    Route::delete('/branch/{id}/delete', [BranchController::class, 'destroy'])->name('delbranch');

    //EMPLOYEE
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/postemployee', [EmployeeController::class, 'store'])->name('postemployee');
    Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('updateemployee');
    Route::delete('/employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('delemployee');

    //LEAVE
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave');
    Route::post('/postleave', [LeaveController::class, 'store'])->name('postleave');
    Route::put('/leave/{id}/update', [LeaveController::class, 'update'])->name('updateleave');
    Route::delete('/leave/{id}/delete', [LeaveController::class, 'destroy'])->name('delleave');

    //OVERTIME
    Route::get('/overtime', [OvertimeController::class, 'index'])->name('overtime');
    Route::get('/addovertime', [OvertimeController::class, 'create'])->name('addovertime');
    Route::post('/postovertime', [OvertimeController::class, 'store'])->name('postovertime');
    Route::get('/editovertime/{id}', [OvertimeController::class, 'edit'])->name('editovertime');
    Route::put('/overtime/{id}/update', [OvertimeController::class, 'update'])->name('updateovertime');
    Route::delete('/overtime/{id}/delete', [OvertimeController::class, 'destroy'])->name('delovertime');

    //NOTE
    Route::get('/note', [NoteController::class, 'index'])->name('note');
    Route::post('/postnote', [NoteController::class, 'store'])->name('postnote');
    Route::put('/note/{id}/update', [NoteController::class, 'update'])->name('updatenote');
    Route::delete('/note/{id}/delete', [NoteController::class, 'destroy'])->name('delnote');

    //ATTENDANCE
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/postattendance', [AttendanceController::class, 'store'])->name('postattendance');
    Route::put('/attendance/{id}/update', [AttendanceController::class, 'update'])->name('updateattendance');
    Route::delete('/attendance/{id}/delete', [AttendanceController::class, 'destroy'])->name('delattendance');

    //SHIFT
    Route::get('/shift', [ShiftController::class, 'index'])->name('shift');
    Route::post('/postshift', [ShiftController::class, 'store'])->name('postshift');
    Route::put('/shift/{id}/update', [ShiftController::class, 'update'])->name('updateshift');
    Route::delete('/shift/{id}/delete', [ShiftController::class, 'destroy'])->name('delshift');

    //PAYROLL
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
    Route::post('/postpayroll', [PayrollController::class, 'store'])->name('postpayroll');
    Route::put('/payroll/{id}/update', [PayrollController::class, 'update'])->name('updatepayroll');
    Route::delete('/payroll/{id}/delete', [PayrollController::class, 'destroy'])->name('delpayroll');

    //NOTE
    Route::get('/note', [NoteController::class, 'index'])->name('note');
    Route::post('/postnote', [NoteController::class, 'store'])->name('postnote');
    Route::put('/note/{id}/update', [NoteController::class, 'update'])->name('updatenote');
    Route::delete('/note/{id}/delete', [NoteController::class, 'destroy'])->name('delnote');
});
