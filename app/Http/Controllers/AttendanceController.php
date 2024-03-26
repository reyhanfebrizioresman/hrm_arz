<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\EmployeeModel;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Attendance::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            // Filter data kehadiran berdasarkan rentang tanggal yang dipilih
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        $attendances = $query->paginate(10);

        return view('attendance.index', compact('attendances'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048', // Validasi file Excel
        ]);

        try {
            Excel::import(new AttendanceImport, $request->file('file')); // Panggil class import untuk file Excel
            return redirect()->route('attendance.index')->with('success', 'Attendance data imported successfully');
        } catch (\Exception $e) {
            return redirect()->route('attendance.index')->with('error', 'Failed to import attendance data: ' . $e->getMessage());
        }
    }
    public function export(Request $request)
    {
        $query = EmployeeModel::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            // Filter data karyawan berdasarkan rentang tanggal yang dipilih
            $query->whereHas('attendances', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            });
        }

        $employees = $query->get();

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
        //
    }
}
