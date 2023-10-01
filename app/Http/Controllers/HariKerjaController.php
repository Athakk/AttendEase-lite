<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\HariKerja;
use App\Models\User;
use Illuminate\Http\Request;

class HariKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hariKerja = HariKerja::get();
        return view('admin.harikerja.index', compact('hariKerja'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.harikerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_harikerja' => 'required',
        ]);

        HariKerja::create($request->all());
        
        return redirect()->route('hariKerja.index')->with('success', 'Hari kerja berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HariKerja $hariKerja)
    {
        return $hariKerja;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HariKerja $hariKerja)
    {
        return view('admin.harikerja.edit', compact('hariKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HariKerja $hariKerja)
    {

        $request->validate([
            'nm_harikerja' => 'required',
            'senin' => 'nullable',
            'selasa' => 'nullable',
            'rabu' => 'nullable',
            'kamis' => 'nullable',
            'jumat' => 'nullable',
            'sabtu' => 'nullable',
            'minggu' => 'nullable',
        ]);

        $hariKerja->nm_harikerja = $request->nm_harikerja;
        if ($request->senin) {
            $hariKerja->senin = $request->senin ? 1 : 0;
            $hariKerja->selasa = $request->selasa ? 1 : 0;
            $hariKerja->rabu = $request->rabu ? 1 : 0;
            $hariKerja->kamis = $request->kamis ? 1 : 0;
            $hariKerja->jumat = $request->jumat ? 1 : 0;
            $hariKerja->sabtu = $request->sabtu ? 1 : 0;
            $hariKerja->minggu = $request->minggu ? 1 : 0;
        }

        $hariKerja->update();
        
        return redirect()->route('hariKerja.index')->with('success', 'Hari kerja berhasil diubah!');
    }

    public function choose(string $id)
    {
        $hariKerja = HariKerja::find($id);
        $user = User::where('id', auth()->user()->id)->first();
        $absensi = Absensi::where('user_id', auth()->user()->id)->where('tanggal', date('Y-m-d'))->first();

        if (!isset($absensi)) {
            if ($user->hari_kerja_id != $hariKerja->id) {
                $user->hari_kerja_id = $hariKerja->id;
                $user->update();

                return redirect()->back()->with('success', 'Hari kerja berhasil diubah!');
            } else {
                return redirect()->back()->with('error', 'Sudah men-daftar hari kerja ini!');
            }
        } else {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HariKerja $hariKerja)
    {
        HariKerja::destroy($hariKerja->id);
        return response()->json(['status' => 'Hari kerja berhasil dihapus!']);
    }
}
