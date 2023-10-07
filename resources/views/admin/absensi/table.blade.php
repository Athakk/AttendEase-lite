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
                                    <td>{{ isset($item->absensi->tanggal) ? $item->absensi->tanggal : $tanggal }}
                                    </td>
                                    <td>{{ isset($item->absensi->jam_masuk) ? $item->absensi->jam_masuk : '-' }}</td>
                                    <td>{{ isset($item->absensi->jam_keluar) ? $item->absensi->jam_keluar : '-' }}
                                    </td>
                                    <td>
                                        @if (isset($item->absensi->tanggal))
                                            <span class="badge bg-label-primary">Sudah Absen</span>
                                        @else
                                            <span class="badge bg-label-danger">Belum/Tidak Absen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
