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

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = Attendance::query();

        // if ($request->has('start_date') && $request->has('end_date')) {
        //     $startDate = $request->start_date;
        //     $endDate = $request->end_date;

        //     // Filter data kehadiran berdasarkan rentang tanggal yang dipilih
        //     $query->whereBetween('date', [$startDate, $endDate]);
        // }

        // $attendances = $query->paginate(10);
        $employees = EmployeeModel::all();
        $attendances = Attendance::with('employee')->get();
        $title = 'Hapus Departemen!';
        $text = "Apa kamu yakin ingin menghapus departemen?";
        confirmDelete($title, $text);
        return view('attendance.index', compact('attendances','employees'));
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
        $attendances = Attendance::findOrFail($id);
        $attendances->delete();
        return redirect('attendance');
    }
}
