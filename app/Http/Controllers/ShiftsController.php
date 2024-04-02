<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use RealRashid\SweetAlert\Facades\Alert;



class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        $title = 'Hapus Shift!';
        $text = "Apa kamu yakin ingin menghapus Shift?";
        confirmDelete($title, $text);
        return view('shifts.index',compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shifts.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            // 'start_time' => 'required|date_format:H:i',
            // 'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Buat objek Shift baru
        // $shift = new Shift();
        // $shift->name = $request->name;
        

        // // Atur nilai untuk setiap hari
        // $shift->monday = $request->has('monday') ? true : false;
        // $shift->tuesday = $request->has('tuesday') ? true : false;
        // $shift->wednesday = $request->has('wednesday') ? true : false;
        // $shift->thursday = $request->has('thursday') ? true : false;
        // $shift->friday = $request->has('friday') ? true : false;
        // $shift->saturday = $request->has('saturday') ? true : false;
        // $shift->sunday = $request->has('sunday') ? true : false;

        // // Atur nilai opsional untuk istirahat dan toleransi
        // $shift->start_time = $request->start_time ?? '07:00:00';
        // $shift->end_time = $request->end_time ?? '17:00:00';
        // $shift->break_start = $request->break_start ?? null;
        // $shift->break_end = $request->break_end ?? null;
        // $shift->late_tolerance = $request->late_tolerance ?? 0;
        // $shift->early_leave_tolerance = $request->early_leave_tolerance ?? 0;

        // // Simpan shift ke dalam database
        // $shift->save();

        $shiftMonday = new Shift();
        $shiftMonday->name = $request->name;
        $shiftMonday->monday = true;
        $shiftMonday->start_time = $request->start_time_monday ?? '07:00:00';
        $shiftMonday->end_time = $request->end_time_monday ?? '17:00:00';
        // Atur nilai lainnya

        // Selasa
        $shiftTuesday = new Shift();
        $shiftTuesday->name = $request->name;
        $shiftTuesday->tuesday = true;
        $shiftTuesday->start_time = $request->start_time_tuesday ?? '07:00:00';
        $shiftTuesday->end_time = $request->end_time_tuesday ?? '17:00:00';
        // Atur nilai lainnya

        // Simpan kedua shift ke dalam database
        $shiftMonday->save();
        $shiftTuesday->save();

        Alert::success('Selamat', 'Data Telah Berhasil di input'); 

        return redirect()->route('shifts.index')->with('success', 'Shifts created successfully.');

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
        // Mencari data shift berdasarkan ID
        $shift = Shift::findOrFail($id);

        // Mendapatkan hari aktif dari shift (jika ada)
        $shiftDays = $shift->days ? array_keys(array_filter($shift->days)) : [];
        $shiftTimes = [];
        
        if ($shiftDays) {
        // Membuat array kosong untuk menyimpan data waktu shift

        // Mengisi array dengan data waktu shift
        foreach ($shiftDays as $day) {
            $shiftTimes[$day] = [
              'start_time' => $shift->start_times[$day] ?? null,
              'end_time' => $shift->end_times[$day] ?? null,
              'break_start' => $shift->break_starts[$day] ?? null,
              'break_end' => $shift->break_ends[$day] ?? null,
              'shift' => $shift->shifts[$day] ?? null,
              'late_tolerance' => $shift->late_tolerances[$day] ?? null,
              'early_leave_tolerance' => $shift->early_leave_tolerances[$day] ?? null,
            ];
          }
        } else {
          // Penanganan jika tidak ada hari aktif (opsional)
          //  - bisa mengembalikan nilai default untuk $shiftTimes
          //  - bisa menampilkan pesan error
        }
        
    return view('shifts.edit',compact('shift','shiftDays','shiftTimes'));
        
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
        $shift = Shift::findOrFail($id);
        $shift->delete();
        Alert::success('Selamat', 'Data Telah Berhasil di Hapus'); 
        return redirect('shifts');
        
    }
}
