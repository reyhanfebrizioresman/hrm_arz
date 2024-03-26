<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();
        $title = 'Delete Position!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.createOrupdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'job_position' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            Alert::error('Error', 'Validation failed. Please check your input.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Position::create($request->all());
        Alert::success('Success', 'Data has been successfully inserted.');
        return redirect('positions');
    }

    /**
     * Display the specified resource
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
        $position = Position::findOrFail($id);
        return view('positions.createOrupdate',compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $positions = Position::findOrFail($id);
        $request->validate([
            'job_position' => 'required|string|max:255',
        ]);

        $positions->update([
            'job_position' => $request->job_position,
        ]);
        Alert::success('Selamat', 'Data Telah Berhasil di input'); 
        return redirect('positions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $positions = Position::findOrFail($id);
        // $departments->tasks()->delete();
        $positions->delete();
        Alert::success('Selamat', 'Data Telah Berhasil di Hapus'); 
        return redirect('positions');
    }
}
