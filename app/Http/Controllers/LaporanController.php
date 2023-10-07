<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index() {
        return view('admin.laporan.absensi');
    }

    public function cetakAbsensi(Request $request) {

        $tahun = explode('-', $request->bulanTahun)[0];
        $bulan = explode('-', $request->bulanTahun)[1];
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
        $dateObj   = DateTime::createFromFormat('!m', $bulan);
        $bulanHuruf = $bulans[$dateObj->format('F')];

        $totalHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        // dd($totalHari);

        $user = User::where('level', 'user')->with('absensis')->get();

            
            foreach ($user as $key => $value) {
                for ($i=1; $i <= $totalHari ; $i++) { 
                    $tanggal = $tahun . '-' . $bulan . '-' . sprintf('%02d', $i);
                    $userAbsensi = Absensi::whereDate('tanggal', $tanggal)->where('user_id', 2)->first();

                    $absensis[$key][$i] = [
                        'tanggal' => $tanggal,
                        'status' => $userAbsensi,
                        'user_id' => $value->id
                    ];
                }
            }
            //Pengambilan data

            
            $pdf = Pdf::loadView('laporan.absensi', ['absensis' => $absensis, 'user' => $user, 'bulanHuruf' => $bulanHuruf, 'tahun' => $tahun, 'totalHari' => $totalHari]);
            return $pdf->download('Laporan Absensi Bulan ' . $bulanHuruf . ' Tahun ' . $tahun . '.pdf');
    }
}
