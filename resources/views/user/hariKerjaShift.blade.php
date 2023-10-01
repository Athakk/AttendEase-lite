@extends('admin.template.app')

@section('title', 'Hari Kerja & Shift')


@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active fs-5" data-bs-toggle="pill" role="tab" href="#hariKerja">Hari Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" data-bs-toggle="pill" role="tab" href="#shift">Shift</a>
                    </li>
                </ul>
            </div>
            <hr class="m-0">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="hariKerja" role="tabpanel" aria-labelledby="hariKerja">
                        <div class="table-responsive text-nowrap mb-4">
                            <table class="table table-striped" id="hariKerjaTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($hariKerja as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nm_harikerja }}</td>
                                            <td>
                                                @if (Auth::user()->hari_kerja_id == $item->id)
                                                    <a href="{{ route('hariKerja.choose', $item->id) }}">
                                                        <button type="button" class="btn btn-icon btn-success">
                                                            <span class="tf-icons bx bx-check-double"></span>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('hariKerja.choose', $item->id) }}">
                                                        <button type="button" class="btn btn-icon btn-info">
                                                            <span class="tf-icons bx bx-cog"></span>
                                                        </button>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shift" role="tabpanel" aria-labelledby="shift">
                        <div class="table-responsive text-nowrap mb-4">
                            <table class="table" id="shiftTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($shift as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nm_shift }}</td>
                                            <td>
                                                @if (Auth::user()->shift_id == $item->id)
                                                    <a href="{{ route('shift.choose', $item->id) }}">
                                                        <button type="button" class="btn btn-icon btn-success">
                                                            <span class="tf-icons bx bx-check-double"></span>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{ route('shift.choose', $item->id) }}">
                                                        <button type="button" class="btn btn-icon btn-info">
                                                            <span class="tf-icons bx bx-cog"></span>
                                                        </button>
                                                    </a>
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#hariKerjaTable').DataTable();
            $('#shiftTable').DataTable();
        });
    </script>
@endsection
