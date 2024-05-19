<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\EmployeeModel;
use App\Models\SickLeave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SickLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sicks = SickLeave::all();
        $employees = EmployeeModel::all();
        return view('sick_leaves.index',compact('sicks','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateStatus(Request $request, string $id)
    {
        $leave = SickLeave::findOrFail($id);
        $dates = $request->date_time_of;
        $formattedDates = implode(',', $dates);

        $status = $request->input('status');
    
        // dd($leave);
        try {
        // Mulai transaksi database
        DB::beginTransaction();
        $leave->status = $status;
        $leave->save();

        $dates = explode(',', $formattedDates);
        foreach ($dates as $date) {
            // Periksa apakah status_submission tidak sama dengan 'pending'
            if ($request->status !== 'reject') {
                Attendance::create([
                    'employee_id' => $request->employee_id,
                    'date' => $date,
                    'status' => 'sakit',
                ]);
            }
        }

        // Commit transaksi database
        DB::commit();

        return redirect()->route('sick_leaves.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
    } catch (Exception $e) {
        // Rollback transaksi database jika terjadi kesalahan
        DB::rollBack();

        return response()->json(['message' => 'Failed to save data: ' . $e->getMessage()], 500);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    // dd($sick);

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

        return redirect()->route('sick_leaves.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
    } catch (Exception $e) {
        // Rollback transaksi database jika terjadi kesalahan
        DB::rollBack();

        return response()->json(['message' => 'Failed to save data: ' . $e->getMessage()], 500);
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $picture = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture')->store('public/pictures');
        }
    
        $dates = $request->date_time_of;
        $formattedDates = implode(',', $dates);
    
        try {
            // Mulai transaksi database
            DB::beginTransaction();
    
            // Dapatkan objek permission leave yang ingin diupdate
            $sick = SickLeave::findOrFail($id);

            if ($sick->status == 'approve') {
                $sick->status = 'pending';
            } else {
                $sick->status = 'approve';
            }

            $sick->save();
    
            // Update atribut objek permission leave
            $sick->update([
                'employee_id' => $request->employee_id,
                'date' => $request->date,
                'date_time_of' => $formattedDates,
                'picture' => $picture,
                'notes' => $request->notes,
                'status_submission' => 'sakit',
            ]);
            // Hapus semua attendance records yang terkait dengan permission leave ini
            // $sick->attendances()->delete();
    
            // Buat attendance records baru untuk permission leave ini
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
    
            return redirect()->route('sick_leaves.index')->with('success', 'Pengajuan cuti berhasil diupdate.');
        } catch (Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollBack();
    
            return response()->json(['message' => 'Failed to update data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sick = SickLeave::find($id);
        $sick->delete();
        return redirect()->route('sick_leaves.index')->with('success', 'Data berhasil dihapus');
    }
}
