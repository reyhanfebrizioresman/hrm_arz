<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $title = 'Hapus Departemen!';
        $text = "Apa kamu yakin ingin menghapus departemen?";
        confirmDelete($title, $text);
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('departments.createOrupdate',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            Alert::error('Validasi Gagal', 'Input Tidak boleh kosong.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Department::create($request->all());
        Alert::success('Sukses', 'Data Berhasil Di Input.');
        return redirect('departments');
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
        $department = Department::findOrFail($id);
        return view('departments.createOrupdate',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update([
            'name' => $request->name,
        ]);
        Alert::success('Selamat', 'Data Telah Berhasil di Update'); 
        return redirect('departments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departments = Department::findOrFail($id);
        $departments->delete();
        return redirect('departments');

    }
}
