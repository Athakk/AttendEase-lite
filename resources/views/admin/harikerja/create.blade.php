@extends('admin.template.app')

@section('title', 'Hari Kerja')

@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-4 text-gray-800">Tambah Hari Kerja</h5>
                <a href="{{ route('hariKerja.index') }}">
                    <button type="button" class="btn btn btn-outline-danger" fdprocessedid="g81fsj"><i
                            class='bx bxs-chevron-left'></i>&nbsp;Kembali</button>
                </a>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach ($errors->all() as $item)
                                <li> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('hariKerja.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="row mb-3">
                                <label class="form-label" for="nama">Nama Hari Kerja</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nm_harikerja" name="nm_harikerja"
                                        placeholder="Nama Hari Kerja" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" value="Save" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script></script>

@endsection
