<?php

namespace App\Http\Controllers;

use App\Exports\PayrollExport;
use App\Models\EmployeeModel;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
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
        // Fetch employees with attendance within the selected period
        $employeesWithPayroll = Payroll::with('employee')
        ->whereMonth('period', $selectedMonth)
        ->whereYear('period', $selectedYear)
        ->get()
        ->pluck('employee_id')
        ->toArray();
        $employees = EmployeeModel::with(['attendance' => function ($q) use ($startDate, $endDate) {
            $q->whereBetween('date', [$startDate, $endDate])
                ->selectRaw('employee_id,SUM(overtime) as total_overtime, COUNT(CASE WHEN late > 0 THEN 1 END) as total_late')
                // ->selectRaw('employee_id,SUM(late) as total_late')
                ->groupBy('employee_id')
            ;

        }, 'careerHistories.position', 'salaryComponents'])->whereNotIn('id', $employeesWithPayroll)->get();
        $employees->each(function ($employee) {
            $gapok = $employee->salaryComponents->where('name', 'gaji pokok')->first()->pivot->amount;
            $timeOvertime = $employee->attendance->total_overtime ?? 0;
            $lateDays = $employee->attendance->total_late ?? 0;
            $latePinalty = $lateDays * 50000;
            // $totalOvertimeInHours = round(($timeOvertime * 60) / 60, 2);
            $totalOvertimeInHours = round($timeOvertime * 1/60 ,2)  ;
            // dd($totalOvertimeInHours);
            // $overtimePay = $totalOvertimeInHours / 173 * $gapok;

            $totalOvertimePay = ($totalOvertimeInHours > 1) ?
            ((1.5 * 1 / 173 * $gapok) + (($totalOvertimeInHours - 1) * 2 * 1 / 173 * $gapok)) :
            ($totalOvertimeInHours * 1.5 * 1 / 173 * $gapok);
            $employee->gapok = $gapok;
            $employee->latePinalty = $latePinalty;
            $employee->totalOvertimePay = $totalOvertimePay;
            $employee->totalSalary = $totalOvertimePay + $gapok - $latePinalty;
            // $employee->attendance->total_overtime = $employee->attendance->total_overtime ?? 0;
            // $employee->attendance->total_overtime_pay = $employee->attendance->total_overtime * 1.5 * (1 / 173);
        });

        $totalTHP = $employees->sum('totalSalary');
        $totalEmployees = $employees->count();

        // $payrolls = Payroll::all();
        $payrolls = Payroll::whereYear('period', $selectedYear)
        ->whereMonth('period', $selectedMonth)
        ->get();

        $totalThpPayrolls = $payrolls->sum('total_pay');
        $employeePayrolls = $payrolls->pluck('employee_id')->unique()->count();

        return view('payrolls.index', compact('employees','totalEmployees','totalTHP','totalThpPayrolls','employeePayrolls', 'months', 'years', 'selectedMonth', 'selectedYear','payrolls'));
    }

    public function generatePdf(string $id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);
        // $employees = EmployeeModel::with(['payrolls','careerHistories.position','careerHistories.department'])->get();
        $pdf = PDF::loadView('payrolls.invoice', compact('payroll'));
        return $pdf->stream();
    }

    public function payrollExport(Request $request)
    {
        $month = $request->input('bulan');
        $year = $request->input('tahun');
        $payrolls = Payroll::whereYear('period' , $year)
                            ->whereMonth('period' , $month)
                            ->get();
        return Excel::download(new PayrollExport($payrolls,$month, $year), 'payrolls.xlsx');
    }

    public function showPayrollForm()
    {
        
    }

    private function generatePeriods(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
        $startDate = Carbon::create($tahun, $bulan, 26)->startOfDay();
        $endDate = (clone $startDate)->addMonth()->day(25)->endOfDay();

        return back()->with('success', "Payroll generated for period: {$startDate->format('d M Y')} - {$endDate->format('d M Y')}");
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
         // Mendapatkan data karyawan yang dipilih bersama dengan detailnya dari formulir
         $employeeIds = $request->input('employee_ids');
         $positions = $request->input('positions');
         $periods = $request->input('periods');
         $basicSalaries = $request->input('basic_salaries');
         $overtimes = $request->input('overtimes');
         $lates = $request->input('lates');
         $totalSalary = $request->input('total_pays');

         $bulan = $request->input('bulan');
         $tahun = $request->input('tahun');
 
         // Iterasi melalui setiap karyawan yang dipilih dan simpan detailnya ke dalam database
         foreach ($employeeIds as $key => $employeeId) {
             $payroll = Payroll::create([
                 'employee_id' => $employeeId,
                 'position' => $positions[$key],
                 'period' => $periods[$key],
                 'basic_salary' => $basicSalaries[$key],
                 'overtime_pay' => $overtimes[$key],
                 'late_pay' => $lates[$key],
                 'total_pay' => $totalSalary[$key],
             ]);
         }
        //  dd($payroll);

 
         // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
         return redirect()->route('payrolls.index',['bulan' => $bulan, 'tahun' => $tahun])->with('success', 'Payrolls have been successfully saved.');
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
        $payrolls = Payroll::findOrFail($id);
        return view('payrolls.edit',compact('payrolls'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $basicSalaries = $request->input('basic_salary');
        $overtimePays = $request->input('overtime_pay');
        $latePays = $request->input('late_pay');

        foreach ($basicSalaries as $id => $basicSalary) {
            $payroll = Payroll::find($id);
            if ($payroll) {
                // Ambil nilai overtime_pay dan late_pay sesuai dengan id
                $overtimePay = isset($overtimePays[$id]) ? $overtimePays[$id] : 0;
                $latePay = isset($latePays[$id]) ? $latePays[$id] : 0;
                // $basicSalary = isset($basicSalary[$id]) ? $basicSalary[$id] : 0;

                // Hitung total gaji
                $payroll->total_pay = $basicSalary + $overtimePay - $latePay;

                // Simpan nilai basic_salary, overtime_pay, dan late_pay
                $payroll->basic_salary = $basicSalary;
                $payroll->overtime_pay = $overtimePay;
                $payroll->late_pay = $latePay;

                // Simpan perubahan
                $payroll->save();
                // dd($payroll);
            }


        }

        return redirect()->route('payrolls.index',['bulan' => $bulan, 'tahun' => $tahun])->with('success', 'Payrolls updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,string $id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        return redirect()->route('payrolls.index',['bulan' => $bulan, 'tahun' => $tahun])->with('success', 'Payslip deleted successfully.');
    }
}
