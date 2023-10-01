<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\HariKerja;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin(Request $request)
    {
        $user = User::where('level', 'user')->get();

        $user->map(function($q) use ($request) {
            $q->absensi = Absensi::where(['user_id' => $q->id ,'tanggal' => date('Y-m-d')])->first() ?? collect([]);
        });


        return view('admin.absensi.index', compact('user'));
        
    }
    
    public function indexUser()
    {
        $absensi = Absensi::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $absensiNow = Absensi::where(['tanggal' => date('Y-m-d'), 'user_id' => Auth::user()->id])->first();
        
        return view('user.absensi.index', compact('absensi', 'absensiNow'));
    }

    public function indexHariKerjaShift()
    {
        $hariKerja = HariKerja::get();
        $shift = Shift::get();
        return view('user.hariKerjaShift', compact('hariKerja', 'shift'));
    }

    public function absenMasuk() {
        $user = Auth::user();        
        if($user->hari_kerja_id == null){
            return redirect()->back()->with('error', 'Anda belum memilih hari kerja!');
        }

        if($user->shift_id == null){
            return redirect()->back()->with('error', 'Anda belum memilih shift!');
        }   
        
        
        $hari = [
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
            'Sunday' => 'minggu'
        ];
        $hariKerja = HariKerja::where(['id' => $user->hari_kerja_id, $hari[Date('l')] => '1' ])->first();

        if ($hariKerja == null) {
            return redirect()->back()->with('error', 'Absensi hanya bisa dilakukan pada hari kerja!');
        }

        $absensi = Absensi::where(['tanggal' => date('Y-m-d'), 'user_id' => $user->id])->first();
        if (isset($absensi)) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini');
        }
        
        
        $shift = Shift::where(['id' => $user->shift_id])->with('shiftDetails')->first();
        $shiftToday = $shift->shiftDetails[date('N')-1];
        
        if (date('h:i:s') > $this->toTime($this->toDetik($shiftToday->jam_masuk) + $this->toDetik($shiftToday->dispensasi))) {
            return redirect()->back()->with('error', 'Anda sudah melebihi batas waktu absensi! Silahkan hubungi admin');
        }
        
        Absensi::create([
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => date('h:i:s'),
            'user_id' => $user->id
        ]);

        return redirect()->back()->with('success', 'Berhasil melakukan absensi!');
    }
    
    public function absenKeluar() {
        $user = Auth::user();
        $absensi = Absensi::where(['tanggal' => date('Y-m-d'), 'user_id' => $user->id])->first();

        $shift = Shift::where(['id' => $user->shift_id])->with('shiftDetails')->first();
        $shiftToday = $shift->shiftDetails[date('N')-1];
        
        if (date('h:i:s') < $this->toTime($this->toDetik($shiftToday->jam_masuk) + $this->toDetik($shiftToday->dispensasi))) {
            return redirect()->back()->with('error', 'Belum waktunya untuk absen keluar!');
        }

        $absensi->jam_keluar = date('h:i:s');
        $absensi->update();
    }


    private function toDetik($time) {
        $hours = substr($time, 0, 2)*60;
        $minutes = substr($time, 3, 2);
        $second = substr($time, 6, 2);
        $minutes = substr($time, 3, 2)*60;
        $hours = substr($time, 0, 2)*60*60;
        return $hours+$minutes+$second;
    }
    
    private function toTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }
}
