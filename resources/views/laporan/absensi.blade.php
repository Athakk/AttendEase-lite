<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Laporan Absensi Bulan ' . $bulanHuruf . ' Tahun ' . $tahun }}</title>
    <style>
        @page {
            margin: 0.7cm 0.9cm;
            size: A4 portrait;
        }

        .page-break {
            page-break-after: always;
        }

        body {
            background-color: #FFF;
            margin: 0px;
            padding: 0px;
            font-size: 11px;
            font-family: times-roman;
        }

        .main {
            background-color: white;
            width: 19cm;
        }

        .text-center {
            text-align: center;
        }

        .table-main {
            width: 80%;
            margin: 2rem auto;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .header-1 {
            background-color: #70AD47;
            color: #FFF
        }

        .header-2 {
            background-color: #C6E0B4
        }

        .bold {
            font-weight: bold
        }
    </style>
</head>

<body>
    <div class="main">
        <h2 class="text-center">{{ 'Laporan Absensi Bulan ' . $bulanHuruf . ' Tahun ' . $tahun }}</h2>
    </div>

    <div class="table-main">
        <table style="width: 100%">
            <tr>
                <th class="header-1" colspan="33">Absensi Bulan Oktober</th>
            </tr>
            <tr>
                <td class="header-2" style="width: 3%">#</td>
                <td class="header-2" style="width: 20%">Nama</td>
                @for ($i = 1; $i <= $totalHari; $i++)
                    <td class="header-2" style="width: 3%">{{ $i }}</td>
                @endfor
            </tr>
            @foreach ($user as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    @for ($i = 1; $i <= count($absensis[$key]); $i++)
                        <td class="text-center bold">
                            @if ($absensis[$key][$i]['status'] !== null)
                                .
                            @else
                                A
                            @endif
                        </td>
                    @endfor
                </tr>
                @if (fmod($key, 50) == 0)
                    <div class="page-break"></div>
                @endif
            @endforeach
        </table>
    </div>

    <div class="table-sec">
        <table style="width: 20%">
            <tr>
                <td class="text-center bold header-1" colspan="2">Keterangan</td>
            </tr>
            <tr>
                <td style="width: 10%" class="text-center bold header-2">.</td>
                <td>Hadir</td>
            </tr>
            <tr>
                <td style="width: 10%" class="text-center bold header-2">A</td>
                <td>Absen</td>
            </tr>
        </table>
    </div>
</body>

</html>
