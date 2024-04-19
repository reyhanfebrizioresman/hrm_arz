<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::all();
        $title = 'Hapus Gaji!';
        $text = "Apa kamu yakin ingin menghapus Data Gaji?";
        confirmDelete($title, $text);
        return view('salaries.index',compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $salary = new Salary();
        $salary->name = $request->name;
        $salary->category = $request->category;

        // Simpan data salary ke dalam database
        $salary->save();
        return redirect('salaries');
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
        $salaries = Salary::findOrFail($id);
        return view('salaries.edit',compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salaries = Salary::findOrFail($id);
        $salaries->update([
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'category' => $request->category,
        ]);
        return redirect('salaries');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salaries = Salary::findOrFail($id);
        $salaries->delete();
        return redirect('salaries');
    }
}
