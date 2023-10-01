@extends('admin.template.app')

@section('title', 'Absensi')

@section('content')
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
    </div>
@endsection
