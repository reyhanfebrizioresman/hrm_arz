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
    public function index(Request $request)
    {
        $months = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $years = range(date('Y'), date('Y') + 5);

        $selectedMonth = $request->input('bulan');
        $selectedYear = $request->input('tahun');

        // If no month and year selected, default to current month and year
        if (!$selectedMonth || !$selectedYear) {
            $selectedMonth = date('m');
            $selectedYear = date('Y');
        }

        // Determine start and end dates
        $startDate = Carbon::create($selectedYear, $selectedMonth, 26)->startOfDay();
        $endDate = (clone $startDate)->addMonth()->day(25)->endOfDay();

        return view('reports.salaries_report',compact('months', 'years', 'selectedMonth', 'selectedYear'));

    }
    public function export(Request $request)
    {   
       
    }
    public function salariesReport(Request $request)
    {

        $months = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $years = range(date('Y'), date('Y') + 5);

        $selectedMonth = $request->input('bulan');
        $selectedYear = $request->input('tahun');

        // If no month and year selected, default to current month and year
        if (!$selectedMonth || !$selectedYear) {
            $selectedMonth = date('m');
            $selectedYear = date('Y');
        }
        $today = Carbon::today()->toDateString();
        $employees = EmployeeModel::with(['attendances' => function($q)use($today){
            $q->where('date', '=', $today);
        } ,'salaryComponents','careerHistories.department'])->get();
        // dd($salaries);
        return view('reports.salaries_report',compact('employees','months', 'years', 'selectedMonth', 'selectedYear'));
    }

    public function salaryExport(Request $request)
    {

        $selectedMonth = $request->input('bulan');
        $selectedYear = $request->input('tahun');

        $startDate = Carbon::create($selectedYear, $selectedMonth, 26)->startOfDay();
        $endDate = (clone $startDate)->addMonth()->day(25)->endOfDay();
        // $startDate = Carbon::parse($request->start_date)->startOfDay();
        // $endDate = Carbon::parse($request->end_date)->endOfDay();
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
