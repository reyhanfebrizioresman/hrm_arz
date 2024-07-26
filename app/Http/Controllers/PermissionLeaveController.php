<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\EmployeeModel;
use App\Models\PermissionLeave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = PermissionLeave::all();
        $employees = EmployeeModel::all();
        return view('permission_leaves.index',compact('permissions','employees'));
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
        $leave = PermissionLeave::findOrFail($id);
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
                    'clock_in' => '00:00',
                    'clock_out' => '00:00',
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
        $picture = null;
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture')->store('public/pictures');
    }

    $dates = $request->date_time_of;
    $formattedDates = implode(',', $dates);

    // Buat objek sickleave di luar blok transaksi
    $permission = PermissionLeave::make([
        'employee_id' => $request->employee_id,
        'date' => $request->date,
        'date_time_of' => $formattedDates,
        'picture' => $picture,
        'notes' => $request->notes,
        'status' => $request->status,
        'status_submission' => 'izin',
    ]);

    // dd($permission);

    try {
        // Mulai transaksi database
        DB::beginTransaction();

        // Simpan objek sickleave ke dalam database
        $permission->save();

        $dates = explode(',', $formattedDates);
        foreach ($dates as $date) {
            // Periksa apakah status_submission tidak sama dengan 'pending'
            if ($request->status !== 'pending') {
                Attendance::create([
                    'employee_id' => $request->employee_id,
                    'clock_in' => '00:00',
                    'clock_out' => '00:00',
                    'date' => $date,
                    'status' => 'izin',
                ]);
            }
        }

        // Commit transaksi database
        DB::commit();

        return redirect()->route('permission_leaves.index')->with('success', 'Pengajuan cuti berhasil disimpan.');
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
    public function update(Request $request, $id)
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
            $permission = PermissionLeave::findOrFail($id);

           
    
            // Update atribut objek permission leave
            $permission->update([
                'employee_id' => $request->employee_id,
                'date' => $request->date,
                'date_time_of' => $formattedDates,
                'picture' => $picture,
                'notes' => $request->notes,
                'status_submission' => 'izin',
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
                            'clock_in' => '00:00',
                            'clock_out' => '00:00',
                            'status' => 'izin',
                        ]);
                }
            }
    
            // Commit transaksi database
            DB::commit();
    
            return redirect()->route('permission_leaves.index')->with('success', 'Pengajuan cuti berhasil diupdate.');
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
        $permission = PermissionLeave::find($id);
        $permission->delete();
        return redirect()->route('permission_leaves.index')->with('success', 'Data berhasil dihapus');
    }
}
