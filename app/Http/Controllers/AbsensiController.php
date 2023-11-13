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
    public function indexAdmin()
    {
        $user = User::where('level', 'user')->get();
        
        
        return view('admin.absensi.index', compact('user'));
    }
    
    public function getByDate(Request $request) {
        $user = User::where(['level' => 'user'])->get();
        $tanggal = $request->date;
        
        $user->map(function($q) use ($request) {
            $q->absensi = Absensi::where(['user_id' => $q->id ,'tanggal' => $request->date])->first() ?? collect([]);
        });

        return view('admin.absensi.table', compact('user', 'tanggal'));
        
    }
    
    public function indexUser()
    {
        $absensi = Absensi::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $absensiNow = Absensi::where(['tanggal' => date('Y-m-d'), 'user_id' => Auth::user()->id])->first();
        //cek absensi

        $bulans = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'Desember' => 'Desember',
        ];
        $bulanNow = $bulans[date('F')];
        //cek bulan
        
        $totalHariNow = cal_days_in_month(CAL_GREGORIAN, date('m'), date("Y"));
        $totalHadir = 0;
        $totalAbsen = 0;

        for ($i=1; $i <= $totalHariNow ; $i++) { 
            $tanggal = date("Y-m") . '-' . sprintf('%02d', $i);
            $userAbsensi = Absensi::whereDate('tanggal', $tanggal)->where('user_id', 2)->first();

            $absensis[$i] = [
                'tanggal' => $tanggal,
                'status' => $userAbsensi == null ? 'absen' : 'hadir',
            ];

            if ($absensis[$i]['status'] == 'absen' && $absensis[$i]['tanggal'] < date('Y-m-d')) {
                $totalAbsen ++;
            } elseif ($absensis[$i]['status'] == 'hadir') {
                $totalHadir ++;
            }
        }

        //cek total absen

        $chartHadir = [];
        $chartAbsen = [];
        $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        foreach ($month as $key => $value) {
            $totalHari = cal_days_in_month(CAL_GREGORIAN, $value, date("Y"));

            $totalHadirChart = 0;
            $totalAbsenChart = 0;

            for ($i=1; $i <= $totalHari ; $i++) { 
                $tanggal = date("Y") . '-' . sprintf('%02d', $value) . '-' . sprintf('%02d', $i);
                $userAbsensi = Absensi::whereDate('tanggal', $tanggal)->where('user_id', 2)->first();
    
                $absensis[$i] = [
                    'tanggal' => $tanggal,
                    'status' => $userAbsensi == null ? 'absen' : 'hadir',
                ];
    
                if ($absensis[$i]['status'] == 'absen' && $absensis[$i]['tanggal'] < date('Y-m-d')) {
                    $totalAbsenChart ++;
                } elseif ($absensis[$i]['status'] == 'hadir') {
                    $totalHadirChart ++;
                }

                if ($i == $totalHari) {
                    array_push($chartHadir, $totalHadirChart);
                    array_push($chartAbsen, $totalAbsenChart);
                }
            }    
        }

        return view('user.absensi.index', compact('absensi', 'absensiNow', 'bulanNow', 'totalHadir', 'totalAbsen', 'chartHadir', 'chartAbsen'));
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
        if ($shift == null) {
            return redirect()->back()->with('error', 'Shift yang anda pilih tidak ditemukan!');
        }

        $shiftToday = $shift->shiftDetails[date('N')-1];
        
        if (date('H:i:s') > $this->toTime($this->toDetik($shiftToday->jam_masuk) + $this->toDetik($shiftToday->dispensasi))) {
            return redirect()->back()->with('error', 'Anda sudah melebihi batas waktu absensi! Silahkan hubungi admin');
        }
        
        Absensi::create([
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => date('H:i:s'),
            'user_id' => $user->id
        ]);

        return redirect()->back()->with('success', 'Berhasil melakukan absensi!');
    }
    
    public function absenKeluar() {
        $user = Auth::user();
        $absensi = Absensi::where(['tanggal' => date('Y-m-d'), 'user_id' => $user->id])->first();

        $shift = Shift::where(['id' => $user->shift_id])->with('shiftDetails')->first();
        if ($shift == null) {
            return redirect()->back()->with('error', 'Shift yang anda pilih tidak ditemukan!');
        }
        
        $shiftToday = $shift->shiftDetails[date('N')-1];
        
        if (date('H:i:s') <= $this->toTime($this->toDetik($shiftToday->jam_keluar) - $this->toDetik($shiftToday->dispensasi))) {
            return redirect()->back()->with('error', 'Belum waktunya untuk absen keluar!');
        }

        // dd($this->toTime($this->toDetik($shiftToday->jam_keluar) + $this->toDetik($shiftToday->dispensasi)));

        $absensi->jam_keluar = date('H:i:s');
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
