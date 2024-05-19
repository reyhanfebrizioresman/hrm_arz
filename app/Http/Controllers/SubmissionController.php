<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CategoryLeave;
use App\Models\EmployeeModel;
use App\Models\PaidLeave;
use App\Models\SickLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;


class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = ['sakit'];
        $employees = EmployeeModel::all();
        $sicks = SickLeave::all();
        $categories = CategoryLeave::all();
        return view('submissions.index',compact('employees','sicks','status','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $status = ['sakit'];
        $employees = EmployeeModel::all();
        return view('submissions.create',compact('employees','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'date' => 'required|date',
    //     'date_time_off' => 'required|array', // Mengubah menjadi array karena dapat memilih lebih dari satu tanggal
    //     'date_time_off.*' => 'required|date', // Validasi untuk setiap tanggal yang dipilih
    //     'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     'notes' => 'nullable|string',
    //     'status_submission' => 'nullable|boolean',
    // ]);
    // $picture = null;
    // if ($request->hasFile('picture')) {
    //     $picture = $request->file('picture')->store('public/pictures');
    // }

    // $status = $request->status_submission ? 'sakit' : null;
    // $date = $request->date_time_of;

    $sick = CategoryLeave::create([
        'name' => $request->name,
        'maximum_leaves' => $request->maximum_leaves,
    ]);

    // if ($date){
    //     Attendance::where('employee_id', $sick->employee_id)
    //                     ->where('date', $date)
    //                     ->update(['date' => $date]);
    // }
    // if ($status === 'sakit') {
    //     Attendance::where('employee_id', $sick->employee_id)
    //                     ->where('date', $date)
    //                     ->update(['status' => 'sakit']);
    // }
    return redirect()->route('submissions.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
    }


    public function sickLeave(Request $request)
{
    $picture = null;
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture')->store('public/pictures');
    }

    $dates = $request->date_time_of;
    $formattedDates = implode(',', $dates);

    // Buat objek sickleave di luar blok transaksi
    $sick = SickLeave::make([
        'employee_id' => $request->employee_id,
        'date' => $request->date,
        'date_time_of' => $formattedDates,
        'picture' => $picture,
        'notes' => $request->notes,
        'status' => $request->status,
        'status_submission' => 'sakit',
    ]);

    try {
        // Mulai transaksi database
        DB::beginTransaction();

        // Simpan objek sickleave ke dalam database
        $sick->save();

        $dates = explode(',', $formattedDates);
        foreach ($dates as $date) {
            // Periksa apakah status_submission tidak sama dengan 'pending'
            if ($request->status !== 'pending') {
                Attendance::create([
                    'employee_id' => $request->employee_id,
                    'date' => $date,
                    'status' => 'sakit',
                ]);
            }
        }

        // Commit transaksi database
        DB::commit();

        return redirect()->route('attendance.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
    } catch (Exception $e) {
        // Rollback transaksi database jika terjadi kesalahan
        DB::rollBack();

        return response()->json(['message' => 'Failed to save data: ' . $e->getMessage()], 500);
    }
}

    public function paidLeave(Request $request)
    {
    $status = $request->status_submission ? 'cuti' : null;
    $date = $request->date_time_of;

    $sick = SickLeave::create([
        'employee_id' => $request->employee_id,
        'date' => $request->date,
        'date_time_of' => $date,
        'notes' => $request->notes,
        'status_submission' => $status,
    ]);

    if ($date){
        Attendance::where('employee_id', $sick->employee_id)
                        ->where('date', $date)
                        ->update(['date' => $date]);
    }
    if ($status === 'cuti') {
        Attendance::where('employee_id', $sick->employee_id)
                        ->where('date', $date)
                        ->update(['status' => 'cuti']);
    }
    return redirect()->route('attendance.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
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
