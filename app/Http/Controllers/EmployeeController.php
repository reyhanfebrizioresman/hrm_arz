<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd(request()->file('picture'));
        // Define validation rules for each field
        $employee = request()->validate([
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
            'picture' => 'image|mimes:jpeg,png,jpg', // Optional picture upload
            'joining_date' => 'required|date',
            'exit_date' => 'nullable|date', // Optional exit date
        ]);
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $fileName = Str::random(20) . '.' . $picture->getClientOriginalExtension();
            $path = $picture->storeAs('public/pictures', $fileName);
        } else {
            // Jika tidak ada gambar yang diunggah, berikan nilai default
            $fileName = 'default.jpg';
        }
        EmployeeModel::create($employee);

        // $employee = EmployeeModel::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone_number' => $request->phone_number,
        //     'identity_no' => $request->identity_no,
        //     'gender' => $request->gender,
        //     'city' => $request->city,
        //     'date_of_birth' => $request->date_of_birth,
        //     'address' => $request->address,
        //     'marital_status' => $request->marital_status,
        //     'employment_status' => $request->employment_status,
        //     'joining_date' => $request->joining_date,
        //     'exit_date' => $request->exit_date,
        // ]);
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
        $employee = EmployeeModel::findOrFail($id);
        // $departments->tasks()->delete();
        $employee->delete();
        return redirect('employee');

    }
}
