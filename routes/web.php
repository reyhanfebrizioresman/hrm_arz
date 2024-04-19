<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftsController;
use App\Exports\AttendanceExport;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/positions', PositionController::class);
    Route::resource('/carieerHistory', CareerHistoryController::class);
    Route::patch('/employee/{id}/toggleStatus', [EmployeeController::class, 'toggleStatus'])->name('employee.toggleStatus');
    Route::get('/employee/{id}/addShift', [EmployeeController::class, 'addShift'])->name('employee.addShift');
    Route::post('/employee/storeShift', [EmployeeController::class, 'storeShift'])->name('employee.storeShift');
    Route::get('/employee/{id}/addSalary', [EmployeeController::class, 'addSalary'])->name('employee.addSalary');
    Route::post('/employee/storeSalary', [EmployeeController::class, 'storeSalary'])->name('employee.storeSalary');
    Route::get('/employee/{employeeId}/edit-salary/{salaryId}', [EmployeeController::class, 'editSalary'])->name('employee.editSalary');
    Route::put('/employee/{employeeId}/update-salary/{salaryId}', [EmployeeController::class, 'updateSalary'])->name('employee.updateSalary');
    Route::delete('/employee/{employeeId}/delete-salary/{salaryId}', [EmployeeController::class, 'deleteSalary'])->name('employee.deleteSalary');
    Route::resource('/attendance', AttendanceController::class);
    Route::get('/viewExport',[AttendanceController::class, 'viewExport'])->name('attendance.viewExport');
    Route::resource('/shifts', ShiftsController::class); 
    Route::resource('/salaries', SalaryController::class);
    Route::get('/attendance/filter', [AttendanceController::class, 'filterByDate'])->name('attendance.filter');
    Route::post('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
    Route::post('/attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');
    Route::post('/attendance/exportAttendance', [AttendanceController::class, 'exportAttendance'])->name('attendance.exportAttendance');
});

require __DIR__.'/auth.php';
