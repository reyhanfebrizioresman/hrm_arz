<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = EmployeeModel::all();
        return view('employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = EmployeeModel::all();
        return view('employee.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd(request()->file('picture'));
        // Define validation rules for each field
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employee', // Unique email check
            'phone_number' => 'required|string',
            'identity_no' => 'required|string|unique:employee', // Unique ID check
            'gender' => 'required|string',
            'city' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'marital_status' => 'required|string',
            'employment_status' => 'required|string',
            'picture' => 'image|mimes:jpeg,png,jpg', 
            'joining_date' => 'required|date',
            'exit_date' => 'nullable|date', 
        ]);
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            // $fileName = time()."_".$picture->getClientOriginalName();
            $fileName = Str::random(20) . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/pictures',$fileName );
        } else {
            // Jika tidak ada gambar yang diunggah, berikan nilai default
            $fileName = 'default.jpg';
        }
        $employee = EmployeeModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'picture' => $fileName,
            'phone_number' => $request->phone_number,
            'identity_no' => $request->identity_no,
            'gender' => $request->gender,
            'city' => $request->city,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'marital_status' => $request->marital_status,
            'employment_status' => $request->employment_status,
            'joining_date' => $request->joining_date,
            'exit_date' => $request->exit_date,
        ]);
        // ddd(request()->file('picture'));

        //  // Handle picture upload (optional)
        //  if ($request->hasFile('picture')) {
        //     $picture = $request->file('picture');
        //     $fileName = Str::random(20) . '.' . $picture->getClientOriginalExtension();
        //     $path = $picture->storeAs('public/pictures', $fileName);
        // } else {
        //     // Jika tidak ada gambar yang diunggah, berikan nilai default
        //     $fileName = 'default.jpg';
        // }

        return redirect('employee');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = EmployeeModel::findOrFail($id);
        $employee->careerHistories()->pluck('id');
        return view('employee.show',compact('employee'));
    }

    public function showCareer(Employee $employee)
    {
        $careerHistories = $employee->careerHistories;
        return view('carieerHistory.show',compact('careerHistories'));
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
    // Cari employee yang akan diperbarui
    $employee = EmployeeModel::findOrFail($id);
    // Validasi request
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required',
        'identity_no' => 'required',
        'gender' => 'required',
        'city' => 'required',
        'date_of_birth' => 'required|date',
        'address' => 'required',
        'marital_status' => 'required',
        'employment_status' => 'required',
        'joining_date' => 'required|date',
        'exit_date' => 'required|date',
    ]);
    // Atur nilai default untuk nama file gambar
    $fileName = $employee->picture;

    // Periksa apakah ada gambar yang diunggah
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $fileName = time() . "_" . $picture->getClientOriginalName();
        // Simpan gambar baru
        $picture->storeAs('public/pictures', $fileName);
        // Hapus gambar lama jika bukan default
        if ($employee->picture !== 'default.jpg') {
            Storage::delete('public/pictures/' . $employee->picture);
        }
    }

    // Perbarui data employee
    $employee->update([
        'name' => $request->name,
        'email' => $request->email,
        'picture' => $fileName,
        'phone_number' => $request->phone_number,
        'identity_no' => $request->identity_no,
        'gender' => $request->gender,
        'city' => $request->city,
        'date_of_birth' => $request->date_of_birth,
        'address' => $request->address,
        'marital_status' => $request->marital_status,
        'employment_status' => $request->employment_status,
        'joining_date' => $request->joining_date,
        'exit_date' => $request->exit_date,
    ]);

    return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = EmployeeModel::findOrFail($id);
        if ($employee->picture) {
            Storage::delete('public/pictures/' . $employee->picture);
        }
        // $departments->tasks()->delete();
        $employee->delete();
        return redirect('employee');

    }
}
