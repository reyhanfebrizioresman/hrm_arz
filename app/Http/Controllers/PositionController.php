<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use RealRashid\SweetAlert\Facades\Alert;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();
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
        Position::create($request->all());
        // Alert::success('Congrats', 'You\'ve Successfully Registered'); 
        return redirect('positions');
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
        return redirect('positions');
    }
}
