<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shift = Shift::get();
        return view('admin.shift.index', compact('shift'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_shift' => 'required',
        ]);

        Shift::create($request->all());
        
        return redirect()->route('shift.index')->with('success', 'Shift berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        return view('admin.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, shift $shift)
    {
        $request->validate([
            'nm_shift' => 'required',
        ]);

        $shift->nm_shift = $request->nm_shift;
        $shift->update();
        
        return redirect()->route('shift.index')->with('success', 'Shift berhasil diubah!');
    }

    public function choose(string $id) 
    {
        $shift = Shift::find($id);
        $user = User::where('id', auth()->user()->id)->first();
        $absensi = Absensi::where('user_id', auth()->user()->id)->where('tanggal', date('Y-m-d'))->first();

        if (!isset($absensi)) {
            if ($user->shift_id != $shift->id) {
                $user->shift_id = $shift->id;
                $user->update();

                return redirect()->back()->with('success', 'Shift berhasil diubah!');
            } else {
                return redirect()->back()->with('error', 'Sudah men-daftar shift ini!');
            }
        } else {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        Shift::destroy($shift->id);
        return response()->json(['status' => 'Shift berhasil dihapus!']);
    }
}