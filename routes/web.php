<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftsController;
use App\Exports\AttendanceExport;

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
    Route::resource('/attendance', AttendanceController::class);
    Route::resource('/shifts', ShiftsController::class);
    // Route::get('/attendance/import-export', [AttendanceController::class, 'importExport'])->name('attendance.importExport');

    // Route::get('/export/attendance', function () {
    //     return Excel::download(new AttendanceExport, 'attendance.xlsx');
    // });
    Route::get('/attendance/filter', [AttendanceController::class, 'filterByDate'])->name('attendance.filter');
    Route::post('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
    Route::post('/attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');
});

require __DIR__.'/auth.php';
