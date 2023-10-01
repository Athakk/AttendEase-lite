<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftDetail;
use Illuminate\Http\Request;

class ShiftDetailController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function Detail(string $id)
    {
        $shift = Shift::find($id);
        $shiftDetail = ShiftDetail::where('shift_id', $id)->get();

        return view('admin.shift.detail', compact('shift', 'shiftDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (isset($request->shift[0]['id'])) {
            for ($i=0; $i < count($request->shift); $i++) { 

                $shiftDetail = ShiftDetail::where('id', $request->shift[$i]['id'])->first();

                $shiftDetail->shift_id =  $id;
                $shiftDetail->hari =  $request->shift[$i]['hari'];
                $shiftDetail->jam_masuk =  $request->shift[$i]['jam_masuk'];
                $shiftDetail->jam_keluar =  $request->shift[$i]['jam_keluar'];
                $shiftDetail->dispensasi =  $request->shift[$i]['dispensasi'];

                $shiftDetail->update();
            }
        } else {
            for ($i=0; $i < count($request->shift); $i++) { 
                ShiftDetail::create([
                    "shift_id" => $id,
                    "hari" => $request->shift[$i]['hari'],
                    "jam_masuk" => $request->shift[$i]['jam_masuk'],
                    "jam_keluar" => $request->shift[$i]['jam_keluar'],
                    "dispensasi" => $request->shift[$i]['dispensasi'],
                ]);
            }
        }
        
        return redirect()->route('shift.index')->with('success', 'Detail shift berhasil ditambah!');;

    }
}
