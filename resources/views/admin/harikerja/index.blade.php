@extends('admin.template.app')

@section('title', 'Hari Kerja')

@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Hari Kerja</h4>
                <div class="d-flex gap-1 justify-content-end align-items-center">
                    <a href="{{ route('hariKerja.create') }}">
                        <button type="button" class="btn btn-primary">
                            <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Hari Kerja</button>
                    </a>
                </div>
            </div>
            <hr class="m-0 " />
            <div class="card-body">
                <div class="table-responsive text-nowrap mb-4">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($hariKerja as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nm_harikerja }}</td>
                                    <td class="d-flex gap-1">
                                        <button type="button"
                                            onclick="showDetail({{ $item->id }}, '{{ route('hariKerja.update', $item->id) }}')"
                                            {{-- data-bs-toggle="modal" data-bs-target="#modalHariKerja" --}} class="btn btn-icon btn-info">
                                            <span class="tf-icons bx bx-book-open"></span>
                                        </button>
                                        <a href="{{ route('hariKerja.edit', $item->id) }}">
                                            <button type="button" class="btn btn-icon btn-warning">
                                                <span class="tf-icons bx bx-edit"></span>
                                            </button>
                                        </a>
                                        <button onclick="deleteHariKerja('{{ route('hariKerja.destroy', $item->id) }}')"
                                            type="submit" class="btn btn-icon btn-danger btn-delete">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHariKerja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHariKerjaTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeDetail"
                        aria-label="Close"></button>
                </div>
                <form id="hariKerjaForm" action="{{ route('hariKerja.create') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 ">
                                <input type="hidden" name="nm_harikerja" id="nm_harikerja">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="senin"
                                        name="senin">
                                    <label class="form-check-label" for="senin">
                                        Senin
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="selasa"
                                        name="selasa">
                                    <label class="form-check-label" for="selasa">
                                        Selasa
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="rabu"
                                        name="rabu">
                                    <label class="form-check-label" for="rabu">
                                        Rabu
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="kamis"
                                        name="kamis">
                                    <label class="form-check-label" for="kamis">
                                        Kamis
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="jumat"
                                        name="jumat">
                                    <label class="form-check-label" for="jumat">
                                        Jum'at
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="sabtu"
                                        name="sabtu">
                                    <label class="form-check-label" for="sabtu">
                                        Sabtu
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="minggu"
                                        name="minggu">
                                    <label class="form-check-label" for="minggu">
                                        Minggu
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="closeDetail"
                                data-bs-dismiss="modal">
                                Close
                            </button>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function deleteHariKerja(deleteurl) {
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah dihapus, Anda tidak dapat memulihkan data ini lagi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            $.ajax({
                                type: "DELETE",
                                url: deleteurl,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });

        }

        function showDetail(id, url) {
            $(document).ready(function() {
                $("#modalHariKerja").modal('show')
            });
            $.get('hariKerja/' + id, function(data) {
                $('#modalHariKerjaTitle').text(data.nm_harikerja);
                $('#hariKerjaForm').attr('action', url);
                $('#nm_harikerja').val(data.nm_harikerja);

                if (data.senin == 1) {
                    $('#senin').prop('checked', true);
                }
                if (data.selasa == 1) {
                    $('#selasa').prop('checked', true);
                }
                if (data.rabu == 1) {
                    $('#rabu').prop('checked', true);
                }
                if (data.kamis == 1) {
                    $('#kamis').prop('checked', true);
                }
                if (data.jumat == 1) {
                    $('#jumat').prop('checked', true);
                }
                if (data.sabtu == 1) {
                    $('#sabtu').prop('checked', true);
                }
                if (data.minggu == 1) {
                    $('#minggu').prop('checked', true);
                }

                $('#modalHariKerja').on('hidden.bs.modal', function(e) {
                    if (data.senin == 1) {
                        var senin = $('#senin').prop('checked', false);
                    }
                    if (data.selasa == 1) {
                        var selasa = $('#selasa').prop('checked', false);
                    }
                    if (data.rabu == 1) {
                        var rabu = $('#rabu').prop('checked', false);
                    }
                    if (data.kamis == 1) {
                        var kamis = $('#kamis').prop('checked', false);
                    }
                    if (data.jumat == 1) {
                        var jumat = $('#jumat').prop('checked', false);
                    }
                    if (data.sabtu == 1) {
                        var sabtu = $('#sabtu').prop('checked', false);
                    }
                    if (data.minggu == 1) {
                        var minggu = $('#minggu').prop('checked', false);
                    }
                })
            });

        }
    </script>
@endsection
