@extends('admin.template.app')

@section('title', 'Absensi')

@section('content')
    <div class="row mb-4">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <span class="app-brand-logo demo">
                                    <i class='bx bx-log-in-circle text-primary fs-1'></i>
                                </span>
                            </div>
                            <h3 class="card-title mb-2"> {{ 'Total hadir ' . $bulanNow }}</h3>
                            <span class="fw-semibold fs-5 d-block mb-3"> {{ $totalHadir . ' hari' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <span class="app-brand-logo demo">
                                    <i class='bx bx-log-out-circle text-danger fs-1'></i>
                                </span>
                            </div>
                            <h3 class="card-title mb-2"> {{ 'Total absen ' . $bulanNow }}</h3>
                            <span class="fw-semibold fs-5 d-block mb-3"> {{ $totalAbsen . ' hari' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Absensi</h4>
                <div>
                    @if (!$absensiNow)
                        <a href="{{ route('absensi.absenMasuk') }}">
                            <button type="button" class="btn btn-primary">
                                <span class="tf-icons bx bx-log-in me-1"></span>&nbsp;Absensi Masuk</button>
                        </a>
                    @elseif ($absensiNow->jam_keluar == null)
                        <a href="{{ route('absensi.absenKeluar') }}">
                            <button type="button" class="btn btn-danger">
                                <span class="tf-icons bx bx-log-out me-1"></span>&nbsp;Absensi Keluar</button>
                        </a>
                    @else
                        <button type="button" class="btn btn-success">
                            <span class="tf-icons bx bx-check-double me-1"></span>&nbsp;Sudah Absensi</button>
                    @endif
                </div>
            </div>
            <hr class="m-0" />
            <div class="card-body">
                <div class="table-responsive text-nowrap mb-4">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($absensi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jam_masuk }}</td>
                                    <td>{{ $item->jam_keluar }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="chartHadir" value="{{ json_encode($chartHadir) }}">
        <input type="hidden" id="chartAbsen" value="{{ json_encode($chartAbsen) }}">
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [{
                name: 'Hadir',
                data: JSON.parse(document.getElementById('chartHadir').value),
                colors: '#E91E63'

            }, {
                name: 'Absen',
                data: JSON.parse(document.getElementById('chartAbsen').value),
                color: '#F44336',
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            },
            yaxis: {},
            fill: {
                opacity: 1,
                colors: ['#0275d8', '#d9534f']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

@endsection
