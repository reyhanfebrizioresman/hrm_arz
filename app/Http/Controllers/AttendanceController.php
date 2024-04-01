<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\EmployeeModel;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Attendance::query();
        if ($request->has('date')) {
            $filterDate = $request->input('date');
            $query->where('date', 'like', "%$filterDate%");
        }
        $title = 'Hapus Absensi!';
        $text = "Apa kamu yakin ingin menghapus Absensi?";
        confirmDelete($title, $text);
        $attendances = $query->get();
        $attendances->load('employee');
        return view('attendance.index', compact('attendances'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048', // Validasi file Excel
        ]);
        
        $file = $request->file('file');
        $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Gunakan ekstensi file yang benar
        $file->storeAs('public/excel', $fileName);
        
        $import = Excel::import(new AttendanceImport, storage_path('app/public/excel/' . $fileName)); // Panggil class import untuk file Excel
        Alert::success('Selamat', 'Data Telah Berhasil di Import'); 
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
         // Validasi input
    $request->validate([
        'employee_id' => 'required',
        'clock_in' => 'required',
        'clock_out' => 'required',
        'date' => 'required',
    ]);

    Attendance::create([
        'employee_id' => $request->employee_id,
        'status' => $request->status,
        'overtime' => $request->overtime,
        'clock_in' => $request->clock_in,
        'clock_out' => $request->clock_out,
        'date' => $request->date,
    ]);
    Alert::success('Selamat', 'Data Telah Berhasil di input'); 
    return redirect()->route('attendance.index');
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
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->update([
            'employee_id' => $request->employee_id,
            'status' => $request->status,
            'overtime' => $request->overtime,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'date' => $request->date,
        ]);
    
        Alert::success('Selamat', 'Data Telah Berhasil di Rubah'); 
        return redirect()->route('attendance.index', ['date' => $request->input('date')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $attendances = Attendance::findOrFail($id);
        $attendances->delete();
        Alert::success('Selamat', 'Data Telah Berhasil di Hapus'); 
        return redirect()->route('attendance.index', ['date' => $request->input('date')]);
    }
}
