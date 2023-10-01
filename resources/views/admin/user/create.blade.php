@extends('admin.template.app')

@section('title', 'User')

@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-4 text-gray-800">Tambah User</h5>
                <a href="{{ route('user.index') }}">
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
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="file">Avatar</label>
                                <input type="file" class="dropify form-control" id="file" name="file" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label class="form-label" for="nama">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label" for="email">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="email" autocomplete="off" id="email" name="email" required
                                            class="form-control" placeholder="email" aria-label="achmad.satria"
                                            aria-describedby="email2" />
                                        <span class="input-group-text" id="email2">@example.com</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="password" id="password" name="password" required
                                        fdprocessedid="jw8hfo" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label" for="phone">Whatsapp</label>
                                <div class="col-sm-10">
                                    <input type="text" id="whatsapp" name="whatsapp" required
                                        class="form-control phone-mask" placeholder="088377189910"
                                        aria-describedby="phone" />
                                </div>
                            </div>
                            <hr class="mb-3 " />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <select name="level" class="form-select select2" fdprocessedid="2tnrtb"
                                            placeholder="Pilih Level">
                                            <option disabled selected value="">Pilih Level</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" value="Save" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.dropify').dropify();

        $('.select2').select2();
    </script>

@endsection
