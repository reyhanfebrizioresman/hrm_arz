<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareerHistory;
use App\Models\EmployeeModel;
use App\Models\Position;
use App\Models\Department;

class CareerHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = EmployeeModel::all();
        $positions = Position::all();
        $departments = Department::all();
        $careerHistories = CareerHistory::with('employee', 'position', 'department')->get();
        return view('carieerHistory.index', compact('careerHistories','employees', 'positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = EmployeeModel::all();
        $positions = Position::all();
        $departments = Department::all();
        $careerHistories = CareerHistory::with('employee', 'position', 'department')->get();
        return view('carieerHistory.create', compact('careerHistories','employees', 'positions', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'position_id' => 'required|exists:position,id',
            'department_id' => 'required|exists:department,id',
            'date' => 'required|date',
        ]);

        // Simpan data karier histori baru ke dalam database
        CareerHistory::create([
            'employee_id' => $request->employee_id,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
            'date' => $request->date,
        ]);

        // Redirect ke halaman yang sesuai setelah berhasil menyimpan
        return redirect('carieerHistory');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $careerHistory = CareerHistory::findOrFail($id);
        $careerHistory = $employee->careerHistories;
        return view('carieerHistory.show',compact('careerHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $careerHistory = CareerHistory::findOrFail($id);
        return view('carieerHistory.createOrupdate',compact('careerHistory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $careerHistory = CareerHistory::findOrFail($id);
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'date' => 'required|date',
        ]);
    
        $careerHistory->update([
            'employee_id' => $request->employee_id,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
            'date' => $request->date,
        ]);
        return redirect('carieerHistory');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $careerHistory = CareerHistory::findOrFail($id);
        $careerHistory->delete();
        return redirect()->back()->with('success', 'Career history successfully deleted.');
    }
}
