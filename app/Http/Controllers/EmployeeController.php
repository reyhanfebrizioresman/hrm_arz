<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\CareerHistory;
use App\Models\Position;
use App\Models\Shift;
use App\Models\Department;
use App\Models\Salary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Dashboard'],
            ['title' => 'Karyawan'],
         ];

        $query = EmployeeModel::query();
    if ($request->has('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('phone_number', 'like', "%$search%")
              ->orWhere('identity_no', 'like', "%$search%")
              ->orWhere('gender', 'like', "%$search%")
              ->orWhere('city', 'like', "%$search%")
              ->orWhere('date_of_birth', 'like', "%$search%")
              ->orWhere('address', 'like', "%$search%")
              ->orWhere('marital_status', 'like', "%$search%")
              ->orWhere('status', 'like', "%$search%")
              ->orWhere('employment_status', 'like', "%$search%")
              ->orWhere('joining_date', 'like', "%$search%")
              ->orWhere('exit_date', 'like', "%$search%");
    }
    //withQuertyString agar query tetap ada di page selanjut nya
        $employees = $query->paginate(10)->withQueryString();
        $employees->load('careerHistories.department', 'careerHistories.position');
        $employeeCounts = EmployeeModel::selectRaw('status, COUNT(*) as count')
                                        ->groupBy('status')
                                        ->pluck('count', 'status')
                                        ->toArray();

        return view('employee.index', compact('employees', 'employeeCounts','breadcrumbs'));

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
        return view('employee.create',compact('careerHistories','employees', 'positions', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employee', // Unique email check
            'phone_number' => 'required|string',
            'identity_no' => 'required|string|unique:employee', // Unique ID check
            'emergency_number' => 'required|string|unique:employee', // Unique ID check
            'gender' => 'required|string',
            'religion' => 'required|string',
            'city' => 'required|string',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string',
            // 'address' => 'required|string',
            'status' => 'required',
            'marital_status' => 'required|string',
            'employment_status' => 'required|string',
            'picture' => 'image|mimes:jpeg,png,jpg', 
            'joining_date' => 'required|date',
            'exit_date' => 'nullable|date', 
            'ptkp' => 'required',
        ]);
        if($validator->fails()){
            Alert::error('Error', 'Validation Gagal. Input Tidak boleh kosong.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
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
            'emergency_number' => $request->emergency_number,
            'identity_no' => $request->identity_no,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'city' => $request->city,
            'date_of_birth' => $request->date_of_birth,
            'place_of_birth' => $request->place_of_birth,
            'address' => $request->address,
            'status' => $request->status,
            'marital_status' => $request->marital_status,
            'employment_status' => $request->employment_status,
            'joining_date' => $request->joining_date,
            'exit_date' => $request->exit_date,
            'ptkp' => $request->ptkp,
        ]);
        CareerHistory::create([
                'employee_id' => $employee->id,
                'position_id' => $request->position_id,
                'department_id' => $request->department_id,
                'date' => $request->date,
            ]);
            Alert::success('Selamat', 'Data Telah Berhasil di input'); 
            return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employees = EmployeeModel::findOrFail($id);

        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Dashboard'],
            ['url' => url('/employee'), 'title' => 'Karyawan'],
            ['title' => $employees->name],
        ];
        $employees->careerHistories()->pluck('id');
        return view('employee.show',compact('employees','breadcrumbs'));
    }

    public function toggleStatus($id)
    {
        // Temukan karyawan berdasarkan ID
        $employee = EmployeeModel::findOrFail($id);

        // Periksa status checkbox
        if ($employee->status == 'active') {
            $employee->status = 'inactive';
        } else {
            $employee->status = 'active';
        }
        // Simpan perubahan status
        $employee->save();
        Alert::success('Selamat', 'Status Karyawan Berhasil Di ubah'); 
        // Kirim respons JSON dengan status berhasil
        return redirect()->back()->with('success', 'Status karyawan berhasil diperbarui.');
    }
    public function addShift($id)
    {
        $employee = EmployeeModel::findOrFail($id);
        $shifts = Shift::all();
        return view('employee.addShift',compact('employee','shifts'));
    }
    public function storeShift(Request $request, EmployeeModel $employee)
    {
        $employeeId = $request->input('employee_id');
        $shiftIds = $request->input('shifts');
    
        // Pastikan employee_id tidak null
        if (!$employeeId) {
            return response()->json(['error' => 'Employee ID is required.'], 400);
        }
    
        // Attach shifts to the employee
        $employee = EmployeeModel::find($employeeId);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    
        $employee->shifts()->attach($shiftIds);
        Alert::success('Selamat', 'Shift Telah di Tambahkan di Karyawan'); 
        return redirect()->route('employee.show',$employeeId);
    }
    public function addSalary($id)
    {
        $employee = EmployeeModel::findOrFail($id);
        $selectedSalaries = $employee->salaryComponents->pluck('id')->toArray();
        $salaries = Salary::all();
        return view('employee.addSalary',compact('employee','salaries','selectedSalaries'));
    }
    public function storeSalary(Request $request, EmployeeModel $employee)
    {
        $employeeId = $request->input('employee_id');
        
        // Pastikan employee_id tidak null
        if (!$employeeId) {
            return response()->json(['error' => 'Employee ID is required.'], 400);
        }
    
        // Attach shifts to the employee
        $employee = EmployeeModel::find($employeeId);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    
        foreach ($request->input('salaryComponents') as $salaryComponentId) {
            $amount = $request->input('amount');
            $employeeId = $request->input('employee_id');
            $employee->salaryComponents()->attach($salaryComponentId, [
                'amount' => $amount,
                'employee_id' => $employeeId,
        ]);
        }
        // dd($employee);
        Alert::success('Selamat', 'Gaji Telah di Tambahkan di Karyawan'); 
        return redirect()->route('employee.show',$employeeId);
    }

    public function editSalary($employeeId, $salaryId)
    {
         // Cari karyawan
         $employee = EmployeeModel::findOrFail($employeeId);
         $salaryComponent = $employee->salaryComponents()->findOrFail($salaryId);
        return view('employee.editSalary', compact('employee','salaryComponent'));
    }

    public function updateSalary(Request $request, $employeeId, $salaryId)
{
    // Validasi data yang diterima dari formulir

    $employee = EmployeeModel::findOrFail($employeeId);
    $salaryComponent = $employee->salaryComponents()->findOrFail($salaryId);
    // Update jumlah gaji pada pivot tabel
    $employee->salaryComponents()->updateExistingPivot($salaryComponent->id, ['amount' => $request->amount]);

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
    Alert::success('Selamat', 'Gaji Telah Berhasil di Update'); 
    return redirect()->route('employee.show',$employeeId);
}

    public function deleteSalary($employeeId, $salaryId)
    {
        // Cari karyawan
        $employee = EmployeeModel::findOrFail($employeeId);

        // Cari komponen gaji yang akan dihapus
        $salaryComponent = Salary::findOrFail($salaryId);

        // Hapus relasi gaji karyawan
        $employee->salaryComponents()->detach($salaryComponent);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->route('employee.show',$employeeId);
    }
    public function showCareer($employee)
    {
        $careerHistories = $employee->careerHistories;
        return view('carieerHistory.show',compact('careerHistories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = EmployeeModel::findOrFail($id);

        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Dashboard'],
            ['url' => url('/employee'), 'title' => 'Karyawan'],
            ['url' => route('employee.show', $employee->id), 'title' => $employee->name],
            ['title' => 'Edit'],
        ];

        $shifts = Shift::all();
        return view('employee.edit',compact('employee','shifts','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Cari employee yang akan diperbarui
    $employee = EmployeeModel::findOrFail($id);
    
    // Validasi request
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:employee', // Unique email check
    //         'phone_number' => 'required|string',
    //         'identity_no' => 'required|string|unique:employee', // Unique ID check
    //         'emergency_number' => 'required|string|unique:employee', // Unique ID check
    //         'gender' => 'required|string',
    //         'religion' => 'required|string',
    //         'city' => 'required|string',
    //         'date_of_birth' => 'required|date',
    //         'address' => 'required|string',
    //         'status' => 'required',
    //         'marital_status' => 'required|string',
    //         'employment_status' => 'required|string',
    //         'picture' => 'image|mimes:jpeg,png,jpg', 
    //         'joining_date' => 'required|date',
    //         'exit_date' => 'required|date', 
    // ]);
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
        'employee_id' => $employee->id,
        'name' => $request->name,
        'email' => $request->email,
        'picture' => $fileName,
        'phone_number' => $request->phone_number,
        'emergency_number' => $request->emergency_number,
        'identity_no' => $request->identity_no,
        'gender' => $request->gender,
        'religion' => $request->religion,
        'city' => $request->city,
        'date_of_birth' => $request->date_of_birth,
        'place_of_birth' => $request->date_of_birth,
        'address' => $request->address,
        'status' => $request->status,
        'marital_status' => $request->marital_status,
        'employment_status' => $request->employment_status,
        'joining_date' => $request->joining_date,
        'exit_date' => $request->exit_date,
        'ptkp' => $request->ptkp,
    ]);

    $employee->shifts()->attach($request->input('shifts'));

    // 
    Alert::success('Selamat', 'Data Telah Berhasil di Update'); 
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
        $employee->delete();
        return redirect('employee');

    }
}
