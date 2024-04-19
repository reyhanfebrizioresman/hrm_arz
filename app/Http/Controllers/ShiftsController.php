<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\EmployeeModel;
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
        $employees = EmployeeModel::all();
        return view('shifts.create',compact('employees'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            
        ]);

       
        $shifts = new Shift([
            'name' => $request->input('name'),
            'monday' => $request->has('monday'),
            'monday_start_time' => $request->input('monday_start_time'),
            'monday_end_time' => $request->input('monday_end_time'),
            'monday_break_start' => $request->input('monday_break_start'),
            'monday_break_end' => $request->input('monday_break_end'),
            'monday_late_tolerance' => $request->input('monday_late_tolerance') ?? 0,
            'monday_early_leave_tolerance' => $request->input('monday_early_leave_tolerance') ?? 0,
            'tuesday' => $request->has('tuesday'),
            'tuesday_start_time' => $request->input('tuesday_start_time'),
            'tuesday_end_time' => $request->input('tuesday_end_time'),
            'tuesday_break_start' => $request->input('tuesday_break_start'),
            'tuesday_break_end' => $request->input('tuesday_break_end'),
            'tuesday_late_tolerance' => $request->input('tuesday_late_tolerance') ?? 0,
            'tuesday_early_leave_tolerance' => $request->input('tuesday_early_leave_tolerance') ?? 0,
            'wednesday' => $request->has('wednesday'),
            'wednesday_start_time' => $request->input('wednesday_start_time'),
            'wednesday_end_time' => $request->input('wednesday_end_time'),
            'wednesday_break_start' => $request->input('wednesday_break_start'),
            'wednesday_break_end' => $request->input('wednesday_break_end'),
            'wednesday_late_tolerance' => $request->input('wednesday_late_tolerance') ?? 0,
            'wednesday_early_leave_tolerance' => $request->input('wednesday_early_leave_tolerance') ?? 0,
            'thursday' => $request->has('thursday'),
            'thursday_start_time' => $request->input('thursday_start_time'),
            'thursday_end_time' => $request->input('thursday_end_time'),
            'thursday_break_start' => $request->input('thursday_break_start'),
            'thursday_break_end' => $request->input('thursday_break_end'),
            'thursday_late_tolerance' => $request->input('thursday_late_tolerance') ?? 0,
            'thursday_early_leave_tolerance' => $request->input('thursday_early_leave_tolerance') ?? 0,
            'friday' => $request->has('friday'),
            'friday_start_time' => $request->input('friday_start_time'),
            'friday_end_time' => $request->input('friday_end_time'),
            'friday_break_start' => $request->input('friday_break_start'),
            'friday_break_end' => $request->input('friday_break_end'),
            'friday_late_tolerance' => $request->input('friday_late_tolerance') ?? 0,
            'friday_early_leave_tolerance' => $request->input('friday_early_leave_tolerance') ?? 0,
            'saturday' => $request->has('saturday'),
            'saturday_start_time' => $request->input('saturday_start_time'),
            'saturday_end_time' => $request->input('saturday_end_time'),
            'saturday_break_start' => $request->input('saturday_break_start'),
            'saturday_break_end' => $request->input('saturday_break_end'),
            'saturday_late_tolerance' => $request->input('saturday_late_tolerance') ?? 0,
            'saturday_early_leave_tolerance' => $request->input('saturday_early_leave_tolerance') ?? 0,
            'sunday' => $request->has('sunday'),
            'sunday_start_time' => $request->input('sunday_start_time'),
            'sunday_end_time' => $request->input('sunday_end_time'),
            'sunday_break_start' => $request->input('sunday_break_start'),
            'sunday_break_end' => $request->input('sunday_break_end'),
            'sunday_late_tolerance' => $request->input('sunday_late_tolerance') ?? 0,
            'sunday_early_leave_tolerance' => $request->input('sunday_early_leave_tolerance') ?? 0,
        ]);
<<<<<<< HEAD
=======

>>>>>>> 4aabeb8e4edb7a77326819faa0827edddd9a4bcd
        $shifts->save();
        

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
        return view('shifts.edit',compact('shift'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shift = Shift::findOrFail($id);
        $shift->update([
            'name' => $request->input('name'),
            'monday' => $request->has('monday'),
            'monday_start_time' => $request->input('monday_start_time'),
            'monday_end_time' => $request->input('monday_end_time'),
            'monday_break_start' => $request->input('monday_break_start'),
            'monday_break_end' => $request->input('monday_break_end'),
            'monday_late_tolerance' => $request->input('monday_late_tolerance') ?? 0,
            'monday_early_leave_tolerance' => $request->input('monday_early_leave_tolerance') ?? 0,
            'tuesday' => $request->has('tuesday'),
            'tuesday_start_time' => $request->input('tuesday_start_time'),
            'tuesday_end_time' => $request->input('tuesday_end_time'),
            'tuesday_break_start' => $request->input('tuesday_break_start'),
            'tuesday_break_end' => $request->input('tuesday_break_end'),
            'tuesday_late_tolerance' => $request->input('tuesday_late_tolerance') ?? 0,
            'tuesday_early_leave_tolerance' => $request->input('tuesday_early_leave_tolerance') ?? 0,
            'wednesday' => $request->has('wednesday'),
            'wednesday_start_time' => $request->input('wednesday_start_time'),
            'wednesday_end_time' => $request->input('wednesday_end_time'),
            'wednesday_break_start' => $request->input('wednesday_break_start'),
            'wednesday_break_end' => $request->input('wednesday_break_end'),
            'wednesday_late_tolerance' => $request->input('wednesday_late_tolerance') ?? 0,
            'wednesday_early_leave_tolerance' => $request->input('wednesday_early_leave_tolerance') ?? 0,
            'thursday' => $request->has('thursday'),
            'thursday_start_time' => $request->input('thursday_start_time'),
            'thursday_end_time' => $request->input('thursday_end_time'),
            'thursday_break_start' => $request->input('thursday_break_start'),
            'thursday_break_end' => $request->input('thursday_break_end'),
            'thursday_late_tolerance' => $request->input('thursday_late_tolerance') ?? 0,
            'thursday_early_leave_tolerance' => $request->input('thursday_early_leave_tolerance') ?? 0,
            'friday' => $request->has('friday'),
            'friday_start_time' => $request->input('friday_start_time'),
            'friday_end_time' => $request->input('friday_end_time'),
            'friday_break_start' => $request->input('friday_break_start'),
            'friday_break_end' => $request->input('friday_break_end'),
            'friday_late_tolerance' => $request->input('friday_late_tolerance') ?? 0,
            'friday_early_leave_tolerance' => $request->input('friday_early_leave_tolerance') ?? 0,
            'saturday' => $request->has('saturday'),
            'saturday_start_time' => $request->input('saturday_start_time'),
            'saturday_end_time' => $request->input('saturday_end_time'),
            'saturday_break_start' => $request->input('saturday_break_start'),
            'saturday_break_end' => $request->input('saturday_break_end'),
            'saturday_late_tolerance' => $request->input('saturday_late_tolerance') ?? 0,
            'saturday_early_leave_tolerance' => $request->input('saturday_early_leave_tolerance') ?? 0,
            'sunday' => $request->has('sunday'),
            'sunday_start_time' => $request->input('sunday_start_time'),
            'sunday_end_time' => $request->input('sunday_end_time'),
            'sunday_break_start' => $request->input('sunday_break_start'),
            'sunday_break_end' => $request->input('sunday_break_end'),
            'sunday_late_tolerance' => $request->input('sunday_late_tolerance') ?? 0,
            'sunday_early_leave_tolerance' => $request->input('sunday_early_leave_tolerance') ?? 0,
        ]);
        return redirect('shifts');
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
