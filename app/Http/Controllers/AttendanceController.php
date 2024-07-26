<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\EmployeeModel;
use App\Exports\AttendanceExport;
use App\Exports\AllAttendanceExport;
use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Exception;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Dashboard'],
            ['title' => 'Absensi'],
         ];

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

        $filterDate = $request->has('date') && !empty($request->date) ? $request->input('date') : null;
        $today = Carbon::today()->toDateString();
        $employees = EmployeeModel::with(['attendance' => function($query)use($filterDate,$today){
            $date = $filterDate ? Carbon::parse($filterDate) : $today;

            // Subquery untuk mendapatkan kehadiran terbaru per employee per date
            $query->whereIn('id', function($subQuery) use ($date) {
                $subQuery->selectRaw('MAX(id)')
                         ->from('attendance')
                         ->whereDate('date', $date)
                         ->groupBy('employee_id');
            });
        }])->get();
        // return $employees;
       
        // $title = 'Hapus Absensi!';
        // $text = "Apa kamu yakin ingin menghapus Absensi?";
        // confirmDelete($title, $text);
        // Mendapatkan tanggal hari ini

        // $query = Attendance::query();
        // Filter berdasarkan tanggal (jika ada)
        // if ($filterDate) {
        //     $query->whereDate('date', '=', $filterDate);
        // } else {
        //     // Menampilkan data hari ini
        //     $query->where('date', '=', $today);
        // }
        // Menggunakan distinct untuk mendapatkan employee_id yang unik
        // $attendances = $query->distinct('employee_id')->get();
        // foreach ($attendances as $attendance){
        //     $attendanceModel = new Attendance();
        //     $lateAndOvertime = $attendanceModel->calculateLateAndOvertime($attendance->clock_in,$attendance->clock_out);
        //     $attendance->late = $lateAndOvertime['late'];
        //     $attendance->overtime = $lateAndOvertime['overtime'];
        // }
        // $attendances->load('employee');
        $countStatus = Attendance::selectRaw('status , COUNT(*) as count')
                                    ->groupBy('status')
                                    ->pluck('count','status')
                                    ->toArray();

        return view('attendance.index', compact('employees','countStatus','breadcrumbs','months', 'years', 'selectedMonth', 'selectedYear'));
    }

    // public function viewExport()
    // {
    //     return view('attendance.viewExport');
    // }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048', // Validasi file Excel
        ]);
        
        $file = $request->file('file');
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Gunakan ekstensi file yang benar
        $file->storeAs('public/excel', $fileName);
        $employee_id = EmployeeModel::all();
        $import = Excel::import(new AttendanceImport, storage_path('app/public/excel/' . $fileName)); // Panggil class import untuk file Excel
        // Alert::success('Selamat', 'Data Telah Berhasil di Import'); 
        if($import) {
            return redirect()->route('attendance.index')->with('success', 'Attendance data imported successfully');
        } else {
            return redirect()->route('attendance.index')->with('error', 'Failed to import attendance data');
        }
        
    }
    public function export(Request $request)
    {
        $query = EmployeeModel::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            // Filter data karyawan berdasarkan rentang tanggal yang dipilih
            // $query->whereHas('attendances', function ($query) use ($startDate, $endDate) {
            //     $query->whereBetween('date', [$startDate, $endDate]);
            // });
        }

        $employees = $query->get();
        // return $employees;
        return Excel::download(new AttendanceExport($employees, $request->start_date, $request->end_date), 'attendance.xlsx');
    }

    public function exportAttendance(Request $request)
    {
        $employees = EmployeeModel::all();

        return Excel::download(new AllAttendanceExport($employees), 'all_attendance.xlsx');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = EmployeeModel::all();
        return view('attendance.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'employee_id' => 'required',
                'clock_in' => 'required',
                'clock_out' => 'required',
                'date' => 'required',
            ]);
    
            $overtime = 0;
            $late = 0;
    
            $clockIn = strtotime($request->clock_in);
            $clockOut = strtotime($request->clock_out);
            $defaultStartTime = strtotime('08:00:00');
            $defaultEndTime = strtotime('17:00:00'); 
    
            if ($clockIn > $defaultStartTime) {
                $late = $clockIn - $defaultStartTime;
            }
    
            if ($clockOut > $defaultEndTime) {
                $overtime = $clockOut - $defaultEndTime;
            }
    
            $late = round($late / 60);
            $overtime = round($overtime / 60);
    
            Attendance::create([
                'employee_id' => $request->employee_id,
                'status' => 'hadir',
                'overtime' => $overtime,
                'late' => $late,
                'clock_in' => $request->clock_in,
                'clock_out' => $request->clock_out,
                'date' => $request->date,
            ]);
    
            // Set flash message for success
            return redirect()->route('attendance.index',['date' => $request->input('date')])->with('success', 'Data kehadiran berhasil disimpan.');
        } catch (Exception $e) {
            // Set flash message for error
            return redirect()->route('attendance.index',['date' => $request->input('date')])->with('error', 'Failed to save data: ' . $e->getMessage());
        }
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
        $attendance = Attendance::findOrFail($id);
        $employees = EmployeeModel::all();
        return view('attendance.edit',compact('attendance','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'employee_id' => 'required',
                'clock_in' => 'required',
                'clock_out' => 'required',
                'date' => 'required',
            ]);
    
            $overtime = 0;
            $late = 0;
    
            $clockIn = strtotime($request->clock_in);
            $clockOut = strtotime($request->clock_out);
            $defaultStartTime = strtotime('08:00:00');
            $defaultEndTime = strtotime('17:00:00'); 
    
            if ($clockIn > $defaultStartTime) {
                $late = $clockIn - $defaultStartTime;
            }
    
            if ($clockOut > $defaultEndTime) {
                $overtime = $clockOut - $defaultEndTime;
            }
    
            $late = round($late / 60);
            $overtime = round($overtime / 60);
    
            // Cari entri yang akan diupdate
            $attendance = Attendance::findOrFail($id);
    
            // Update data
            $attendance->update([
                'employee_id' => $request->employee_id,
                'status' => 'hadir',
                'overtime' => $overtime,
                'late' => $late,
                'clock_in' => $request->clock_in,
                'clock_out' => $request->clock_out,
                'date' => $request->date,
            ]);
    
            // Set flash message for success
            return redirect()->route('attendance.index',['date' => $request->input('date')])->with('success', 'Data kehadiran berhasil diperbarui.');
        } catch (Exception $e) {
            // Set flash message for error
            return redirect()->route('attendance.index',['date' => $request->input('date')])->with('error', 'Failed to update data: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        // Temukan data employee berdasarkan ID
        try{
            $employee = Attendance::find($id);
            $employee->delete();
            return redirect()->route('attendance.index', ['date' => $request->input('date')])->with('success','Absen Berhasil Di Hapus');
        }catch(Exception $e){
            return redirect()->route('attendance.index', ['date' => $request->input('date')])->with('error', 'Failed to save data: ' . $e->getMessage());

        }
    }
}
