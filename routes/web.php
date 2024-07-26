<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftsController;
use App\Exports\AttendanceExport;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PaidLeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PermissionLeaveController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SickLeaveController;
use App\Http\Controllers\SubmissionController;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
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
    // Route::get('/report',[ReportSalariesController::class, 'report']);
    Route::get('/attendance/filter', [AttendanceController::class, 'filterByDate'])->name('attendance.filter');
    Route::post('/attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
    Route::post('/attendance/import', [AttendanceController::class, 'import'])->name('attendance.import');
    Route::get('/exportAttendance', [AttendanceController::class, 'exportAttendance'])->name('attendance.exportAttendance');
    Route::get('/reports/salaries_report',[ReportController::class, 'salariesReport'])->name('report.salaries');
    Route::post('/reports/export', [ReportController::class, 'salaryExport'])->name('reports.salaryExport');
    // Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource('/submissions', SubmissionController::class);
    Route::resource('/sick_leaves', SickLeaveController::class);
    Route::resource('/paid_leaves', PaidLeaveController::class);
    Route::resource('/permission_leaves', PermissionLeaveController::class);
    Route::put('/paid_leaves/{id}/updateStatus', [PaidLeaveController::class, 'updateStatus'])->name('paid_leaves.updateStatus');
    Route::put('/sick_leaves/{id}/updateStatus', [SickLeaveController::class, 'updateStatus'])->name('sick_leaves.updateStatus');
    Route::put('/permission_leaves/{id}/updateStatus', [PermissionLeaveController::class, 'updateStatus'])->name('permission_leaves.updateStatus');
    // Route::post('/submissions/paidLeave', [SubmissionController::class, 'paidLeave'])->name('submissions.paidLeave');
    Route::resource('/payrolls', PayrollController::class);
    Route::put('/payrolls/update-all', [PayrollController::class, 'updateAll'])->name('payrolls.updateAll');
    Route::get('/payrolls/invoice/{id} ', [PayrollController::class ,'generatePdf'])->name('payrolls.generatePdf');
    Route::post('/payrolls/export', [PayrollController::class, 'payrollExport'])->name('payrolls.payrollExport');
    // Route::get('/payrolls/export', function (Request $request) {
    //     $month = $request->input('bulan');
    //     $year = $request->input('tahun');
    //     return Excel::download(new PayrollExport($month, $year), 'payrolls.xlsx');
    // })->name('payrolls.export');
    // Route::get('/payroll', [PayrollController::class, 'showPayrollForm'])->name('payroll.index');

});

require __DIR__.'/auth.php';
