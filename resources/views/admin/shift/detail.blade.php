@extends('admin.template.app')

@section('title', 'Shift')

@section('content')
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-4 text-gray-800">Detail Shift {{ $shift->nm_shift }}</h5>
                <a href="{{ route('shift.index') }}">
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
                <form action="{{ route('shiftDetail.update', $shift->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 200px">Hari</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Dispensasi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @if (!empty($shiftDetail[0]))
                                            @foreach ($shiftDetail as $key => $item)
                                                <input type="hidden" name="shift[{{ $key }}][id]"
                                                    value="{{ $item->id }}">
                                                <tr>
                                                    <td>
                                                        <select name="shift[{{ $key }}][hari]" class="form-select"
                                                            fdprocessedid="2tnrtb" placeholder="Pilih Hari">
                                                            <option disabled selected value="">Pilih Hari</option>
                                                            <option value="senin" {{ $key == 0 ? 'selected' : '' }}
                                                                {{ $key != 0 ? 'disabled' : '' }}>Senin
                                                            </option>
                                                            <option value="selasa" {{ $key == 1 ? 'selected' : '' }}
                                                                {{ $key != 1 ? 'disabled' : '' }}>Selasa
                                                            </option>
                                                            <option value="rabu" {{ $key == 2 ? 'selected' : '' }}
                                                                {{ $key != 2 ? 'disabled' : '' }}>Rabu
                                                            </option>
                                                            <option value="kamis" {{ $key == 3 ? 'selected' : '' }}
                                                                {{ $key != 3 ? 'disabled' : '' }}>Kamis
                                                            </option>
                                                            <option value="jumat" {{ $key == 4 ? 'selected' : '' }}
                                                                {{ $key != 4 ? 'disabled' : '' }}>Jum'at
                                                            </option>
                                                            <option value="sabtu" {{ $key == 5 ? 'selected' : '' }}
                                                                {{ $key != 5 ? 'disabled' : '' }}>Sabtu
                                                            </option>
                                                            <option value="minggu" {{ $key == 6 ? 'selected' : '' }}
                                                                {{ $key != 6 ? 'disabled' : '' }}>Minggu
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td><input class="form-control" type="time" id="jam_masuk"
                                                            name="shift[{{ $key }}][jam_masuk]"
                                                            value="{{ old('jam_masuk', $item->jam_masuk) }}">
                                                    </td>
                                                    <td><input class="form-control" type="time" id="jam_keluar"
                                                            name="shift[{{ $key }}][jam_keluar]"
                                                            value="{{ old('jam_keluar', $item->jam_keluar) }}"></td>
                                                    <td><input class="form-control" type="time" id="dispensasi"
                                                            name="shift[{{ $key }}][dispensasi]"
                                                            value="{{ old('dispensasi', $item->dispensasi) }}"></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <?php $i = 0; ?>
                                            @while ($i < 7)
                                                <tr>
                                                    <td>
                                                        <select name="shift[{{ $i }}][hari]"
                                                            class="form-select select2" fdprocessedid="2tnrtb"
                                                            placeholder="Pilih Hari">
                                                            <option disabled selected value="">Pilih Hari</option>
                                                            <option value="senin" {{ $i == 0 ? 'selected' : '' }}>
                                                                Senin
                                                            </option>
                                                            <option value="selasa" {{ $i == 1 ? 'selected' : '' }}>
                                                                Selasa
                                                            </option>
                                                            <option value="rabu" {{ $i == 2 ? 'selected' : '' }}>Rabu
                                                            </option>
                                                            <option value="kamis" {{ $i == 3 ? 'selected' : '' }}>
                                                                Kamis
                                                            </option>
                                                            <option value="jumat" {{ $i == 4 ? 'selected' : '' }}>
                                                                Jum'at
                                                            </option>
                                                            <option value="sabtu" {{ $i == 5 ? 'selected' : '' }}>
                                                                Sabtu
                                                            </option>
                                                            <option value="minggu" {{ $i == 6 ? 'selected' : '' }}>
                                                                Minggu
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td><input class="form-control" type="time" id="jam_masuk"
                                                            name="shift[{{ $i }}][jam_masuk]" required>
                                                    </td>
                                                    <td><input class="form-control" type="time" id="jam_keluar"
                                                            name="shift[{{ $i }}][jam_keluar]" required></td>
                                                    <td><input class="form-control" type="time" id="dispensasi"
                                                            name="shift[{{ $i }}][dispensasi]" required></td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endwhile

                                        @endif

                                    </tbody>
                                </table>
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
@endsection
