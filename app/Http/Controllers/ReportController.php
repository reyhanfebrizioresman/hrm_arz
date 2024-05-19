<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeSalaryExport;
use App\Models\EmployeeModel;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function export(Request $request)
    {   
       
    }
    public function salariesReport()
    {
        $today = Carbon::today()->toDateString();
        $employees = EmployeeModel::with(['attendances' => function($q)use($today){
            $q->where('date', '=', $today);
        } ,'salaryComponents','careerHistories.department'])->get();
        // dd($salaries);
        return view('reports.salaries_report',compact('employees'));
    }

    public function salaryExport(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        // if($request->has('start_date') && $request->has('end_date')){
        //     $startDate = $request->start_date;
        //     $endDate = $request->end_date;
        // }
        $employees = EmployeeModel::with(['attendances' ,'salaryComponents','careerHistories.department'])->get();
        return Excel::download(new EmployeeSalaryExport($employees,$startDate,$endDate), 'employee_salaries.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
