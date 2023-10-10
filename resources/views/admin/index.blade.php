@extends('admin.template.app')

@section('title', 'Dashboard')


@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('backoffice/img/icons/unicons/wallet.png') }}" alt="chart success"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ route('user.index') }}">Lebih lengkap</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">User terdaftar</h3>
                    <span class="fw-semibold fs-5 d-block mb-1"> {{ $user }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('backoffice/img/icons/unicons/chart.png') }}" alt="chart" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ route('hariKerja.index') }}">Lebih lengkap</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">Hari Kerja terdaftar</h3>
                    <span class="fw-semibold fs-5 d-block mb-1">{{ $hariKerja }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('backoffice/img/icons/unicons/paypal.png') }}" alt="paypal"
                                class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="{{ route('shift.index') }}">Lebih lengkap</a>
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title mb-2">Shift terdaftar</h3>
                    <span class="fw-semibold fs-5 d-block mb-1">{{ $shift }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
