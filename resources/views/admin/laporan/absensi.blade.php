@extends('admin.template.app')

@section('title', 'Laporan Absensi')

@section('content')
    <div class="col-xxl">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold m-0">Laporan Absensi</h4>
            </div>
            <hr class="m-0 " />
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('laporan.cetakAbsensi') }}" method="post"
                        class="d-flex justify-content-center align items center gap-2 py-4"">
                        @csrf
                        <div class="col-md-6">
                            <input class="form-control" type="month" value="{{ date('Y-m') }}" id="bulanTahun"
                                name="bulanTahun">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <span class="tf-icons bx bx-printer"></span>&nbsp;Cetak Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function deleteUser(deleteurl) {
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
    </script>
@endsection
