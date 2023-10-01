@extends('admin.template.app')

@section('title', 'Absensi')

@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Absensi</h4>
                <form action="">
                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="html5-date-input" />
                </form>
            </div>
            <hr class="m-0 " />
            <div class="card-body">
                <div class="table-responsive text-nowrap mb-4">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($user as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ isset($item->absensi->tanggal) ? $item->absensi->tanggal : date('Y-m-d') }}</td>
                                    <td>{{ isset($item->absensi->jam_masuk) ? $item->absensi->jam_masuk : '-' }}</td>
                                    <td>{{ isset($item->absensi->jam_keluar) ? $item->absensi->jam_keluar : '-' }}</td>
                                    <td>
                                        @if (isset($item->absensi->tanggal))
                                            <span class="badge bg-label-primary">Sudah Absen</span>
                                        @else
                                            <span class="badge bg-label-danger">Balum/Tidak Absen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
