<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;


class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|array',
            'start_times' => 'required|array',
            'end_times' => 'required|array',
            'break_starts' => 'nullable|array',
            'break_ends' => 'nullable|array',
            'shifts' => 'required|array',
            'late_tolerances' => 'required|array',
            'early_leave_tolerances' => 'required|array',
        ]);

        foreach ($data['days'] as $day => $value) {
            // Pastikan nilai $day adalah salah satu dari nilai yang diharapkan dalam ENUM
            if (in_array($day, ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])) {
                if ($value == 1) {
                    Shift::create([
                        'name' => $data['name'],
                        'day' => $day,
                        'start_time' => $data['start_times'][$day],
                        'end_time' => $data['end_times'][$day],
                        'break_start' => $data['break_starts'][$day],
                        'break_end' => $data['break_ends'][$day],
                        'shift' => $data['shifts'][$day],
                        'late_tolerance' => $data['late_tolerances'][$day],
                        'early_leave_tolerance' => $data['early_leave_tolerances'][$day],
                    ]);
                }
            } else {
                // Jika nilai $day tidak valid, lakukan penanganan kesalahan di sini
                // Misalnya, lewati atau tampilkan pesan kesalahan
                // Di sini saya hanya mencetak pesan kesalahan untuk memudahkan debug
                echo "Error: Invalid day value encountered: $day";
            }
        }
        

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
