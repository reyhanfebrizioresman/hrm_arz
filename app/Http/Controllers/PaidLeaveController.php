<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CategoryLeave;
use App\Models\EmployeeModel;
use App\Models\PaidLeave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaidLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = EmployeeModel::all();
        $categories = CategoryLeave::all();
        $leaves = PaidLeave::all();
        return view('paid_leaves.index',compact('leaves','employees','categories'));
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
        $leave = PaidLeave::findOrFail($id);
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
                    'status' => 'cuti',
                ]);
            }
        }

        // Commit transaksi database
        DB::commit();

        return redirect()->route('paid_leaves.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
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

    $dates = $request->date_time_of;
    $formattedDates = implode(',', $dates);

    // Buat objek sickleave di luar blok transaksi
    $sick = PaidLeave::make([
        'employee_id' => $request->employee_id,
        'categories_id' => $request->categories_id,
        'date' => $request->date,
        'date_time_of' => $formattedDates,
        'notes' => $request->notes,
        'status' => $request->status,
        'status_submission' => 'cuti',
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
                    'status' => 'cuti',
                ]);
            }
        }

        // Commit transaksi database
        DB::commit();

        return redirect()->route('paid_leaves.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $dates = $request->date_time_of;
        $formattedDates = implode(',', $dates);
    
        try {
            // Mulai transaksi database
            DB::beginTransaction();
    
            // Dapatkan objek permission leave yang ingin diupdate
            $leave = PaidLeave::findOrFail($id);

            if ($leave->status == 'approve') {
                $leave->status = 'pending';
            } else {
                $leave->status = 'approve';
            }

            $leave->save();
    
            // Update atribut objek permission leave
            $leave->update([
                'employee_id' => $request->employee_id,
                'date' => $request->date,
                'date_time_of' => $formattedDates,
                'notes' => $request->notes,
                'status_submission' => 'cuti',
            ]);
    
            // $sick->attendances()->delete();
    
            // Buat attendance records baru untuk permission leave ini
            $dates = explode(',', $formattedDates);
            foreach ($dates as $date) {
                // Periksa apakah status_submission tidak sama dengan 'pending'
                if ($request->status !== 'pending') {
                        Attendance::create([
                            'employee_id' => $request->employee_id,
                            'date' => $date,
                            'status' => 'cuti',
                        ]);
                }
            }
    
            // Commit transaksi database
            DB::commit();
    
            return redirect()->route('paid_leaves.index')->with('success', 'Pengajuan cuti berhasil diupdate.');
        } catch (Exception $e) {
            DB::rollBack();
    
            return response()->json(['message' => 'Failed to update data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = PaidLeave::find($id);
        $leave->delete();
        return redirect()->route('paid_leaves.index')->with('success', 'Data berhasil dihapus');
    }
}
