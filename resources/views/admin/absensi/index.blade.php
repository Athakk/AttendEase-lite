@extends('admin.template.app')

@section('title', 'Absensi')

@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Absensi</h4>
                <input class="form-control w-25" onchange="getByDate(this)" type="date" value="{{ date('Y-m-d') }}"
                    id="date" />
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
                                    <td>{{ isset($item->absensis->tanggal) ? $item->absensis->tanggal : date('Y-m-d') }}
                                    </td>
                                    <td>{{ isset($item->absensis->jam_masuk) ? $item->absensis->jam_masuk : '-' }}</td>
                                    <td>{{ isset($item->absensis->jam_keluar) ? $item->absensis->jam_keluar : '-' }}</td>
                                    <td>
                                        @if (isset($item->absensis->tanggal))
                                            <span class="badge bg-label-primary">Sudah Absen</span>
                                        @else
                                            <span class="badge bg-label-danger">Belum/Tidak Absen</span>
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

    <script>
        function getByDate(athak) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/absensi/getByDate",
                data: {
                    'date': athak.value
                },
                success: function(response) {
                    $('#myTable').html(response);
                }
            });
        }
    </script>
@endsection
