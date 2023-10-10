@extends('admin.template.app')

@section('title', 'Shift')

@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Shift</h4>
                <div class="d-flex gap-1 justify-content-end align-items-center">
                    <a href="{{ route('shift.create') }}">
                        <button type="button" class="btn btn-primary">
                            <span class="tf-icons bx bx-plus"></span>&nbsp;Tambah Shift</button>
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
                            @foreach ($shift as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nm_shift }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('shiftDetail.detail', $item->id) }}">
                                            <button type="button" class="btn btn-icon btn-info">
                                                <span class="tf-icons bx bx-book-open"></span>
                                            </button>
                                        </a>
                                        <a href="{{ route('shift.edit', $item->id) }}">
                                            <button type="button" class="btn btn-icon btn-warning">
                                                <span class="tf-icons bx bx-edit"></span>
                                            </button>
                                        </a>
                                        <button onclick="deleteShift('{{ route('shift.destroy', $item->id) }}')"
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHariKerjaTitle">Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="closeDetail"
                        aria-label="Close"></button>
                </div>
                <form id="hariKerjaForm" action="{{ route('hariKerja.create') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Dispensasi</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>
                                                    <select name="level" class="form-select select2"
                                                        fdprocessedid="2tnrtb" placeholder="Pilih Hari">
                                                        <option disabled selected value="">Pilih Hari</option>
                                                        <option value="senin">Senin</option>
                                                        <option value="selasa">Selasa</option>
                                                        <option value="rabu">Rabu</option>
                                                        <option value="kamis">Kamis</option>
                                                        <option value="jumat">Jum'at</option>
                                                        <option value="sabtu">Sabtu</option>
                                                        <option value="minggu">Minggu</option>
                                                    </select>
                                                </td>
                                                <td><input class="form-control" type="time" id="jam_masuk"
                                                        name="jam_masuk"></td>
                                                <td><input class="form-control" type="time" id="jam_keluar"
                                                        name="jam_keluar"></td>
                                                <td><input class="form-control" type="time" id="dispensasi"
                                                        name="dispensasi"></td>
                                                <td><button type="button" class="btn btn-icon btn-outline-danger"
                                                        fdprocessedid="rcxpy">
                                                        <span class="tf-icons bx bx-trash"></span>
                                                    </button></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><button type="button" class="btn btn-icon btn-outline-primary"
                                                        fdprocessedid="rcxpy">
                                                        <span class="tf-icons bx bx-plus"></span>
                                                    </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        function deleteShift(deleteurl) {
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
                                    if (response.status == 'success') {
                                        swal(response.message, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    } else {
                                        swal(response.message, {
                                                icon: "error",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    }
                                }
                            });
                        }
                    });
            });

            function showDetail(id, url) {
                $(document).ready(function() {
                    $("#modalHariKerja").modal('show')
                });
                $.get('hariKerja/' + id, function(data) {
                    $('#modalHariKerjaTitle').text(data.nm_harikerja);
                    $('#hariKerjaForm').attr('action', url);
                    $('#nm_harikerja').val(data.nm_harikerja);
                });
            }

            $('.select2').select2();

        }
    </script>
@endsection
