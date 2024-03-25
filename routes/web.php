<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CareerHistoryController;
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
    Route::get('employee/{employee}/career-history', [App\Http\Controllers\EmployeeController::class, 'showCareer'])->name('employee.careerHistory');
    Route::get('/employee/search', 'EmployeeController@search')->name('employee.search');

});

require __DIR__.'/auth.php';
