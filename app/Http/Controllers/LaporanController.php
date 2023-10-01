<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index() {
        return view('admin.laporan.absensi');
    }

    public function cetakAbsensi(Request $request) {
        //Print EXCEL
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Absensi');

        $writer = new Xlsx($spreadsheet);

    }
}
