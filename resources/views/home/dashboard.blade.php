@extends('layout.layout')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('sidebar')
    @if (Auth::user()->id_role === 1)
        @include('sidebar.sb_departemen')
    @endif
    @if (Auth::user()->id_role === 2)
        @include('sidebar.sb_catering')
    @endif
    @if (Auth::user()->id_role === 3)
        @include('sidebar.sb_hrd')
    @endif
    @if (Auth::user()->id_role === 4)
        @include('sidebar.sb_ga')
    @endif
@endsection

@section('bread')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
        </ol>
        <h4 class="font-weight-bolder text-white mb-0 mt-3">Dashboard</h4>
    </nav>
@endsection

@section('content')
    <style>
        /* Ganti warna panah kiri (Previous) */
        .carousel-control-prev {
            background-color: black;
            /* Ganti dengan warna yang Anda inginkan */
            border-radius: 10px;
        }

        /* Ganti warna panah kanan (Next) */
        .carousel-control-next {
            background-color: black;
            /* Ganti dengan warna yang Anda inginkan */
            border-radius: 10px;
        }

        .timeline-with-icons {
            border-left: 1px solid hsl(0, 0%, 90%);
            list-style: none;
        }

        .timeline-with-icons .timeline-item {
            position: relative;
        }


        .timeline-with-icons .timeline-icon {
            position: absolute;
            left: -56px;
            background-color: hsl(217, 88.2%, 90%);
            color: hsl(217, 88.8%, 35.1%);
            border-radius: 50%;
            height: 45px;
            width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-pills .nav-link.active {
            background-color: #7b5e50 !important;
            /* Warna latar belakang */
            color: white;
            /* Warna teks */
        }

        /* Merubah warna teks pada selector yang tidak aktif */
        .nav-pills .nav-link {
            color: black;
            /* Warna teks default */
        }
    </style>
    @php
        $date = \Carbon\Carbon::now();
    @endphp


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase text-dark font-weight-bold">Menu Spesial</p>
                                    <p class="text-xs mb-0">Tahun {{ $date->isoFormat('YYYY') }}</p>
                                    <div class="d-flex mt-2">
                                        <h5 class="font-weight-bolder">
                                            {{ $menus }}
                                        </h5>
                                        <p class="text-xs mb-0" style="margin-top: 5%;margin-left:3%"> Pesanan</p>
                                    </div>

                                    <p class="d-flex mb-0">
                                        {{-- @if ($perMenus < 0)
                                            <span class="text-danger text-xs font-weight-bolder">{{ $perMenus }}%</span>
                                        @else
                                            <span
                                                class="text-success text-xs font-weight-bolder">+{{ $perMenus }}%</span>
                                        @endif --}}
                                        {{-- <span class="text-xs" style="margin-left: 3%"> dari tahun lalu</span> --}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fa-solid fa-utensils text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase text-dark font-weight-bold">Snack</p>
                                    <p class="text-xs mb-0">Tahun {{ $date->isoFormat('YYYY') }}</p>
                                    <div class="d-flex mt-2">
                                        <h5 class="font-weight-bolder">
                                            {{ $snack }}
                                        </h5>
                                        <p class="text-xs mb-0" style="margin-top: 5%;margin-left:3%"> Pesanan</p>
                                    </div>

                                    <p class="d-flex mb-0">
                                        {{-- @if ($perSnack < 0)
                                            <span class="text-danger text-xs font-weight-bolder">{{ $perSnack }}%</span>
                                        @else
                                            <span
                                                class="text-success text-xs font-weight-bolder">+{{ $perSnack }}%</span>
                                        @endif --}}
                                        {{-- <span class="text-xs" style="margin-left: 3%"> dari tahun lalu</span> --}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="fa-solid fa-cookie-bite text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Others</p>
                                    <p class="text-xs mb-0">Tahun {{ $date->isoFormat('YYYY') }}</p>
                                    <div class="d-flex mt-2">
                                        <h5 class="font-weight-bolder">
                                            {{ $others }}
                                        </h5>
                                        <p class="text-xs mb-0" style="margin-top: 5%;margin-left:3%"> Pesanan</p>
                                    </div>

                                    <p class="d-flex mb-0">
                                        {{-- @if ($perOthers < 0)
                                            <span
                                                class="text-danger text-xs font-weight-bolder">{{ $perOthers }}%</span>
                                        @else
                                            <span
                                                class="text-success text-xs font-weight-bolder">+{{ $perOthers }}%</span>
                                        @endif --}}
                                        {{-- <span class="text-xs" style="margin-left: 3%"> dari tahun lalu</span> --}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fa-solid fa-bowl-food text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Data Makan</p>
                                    <p class="text-xs mb-0">Tahun {{ $date->isoFormat('YYYY') }}</p>
                                    <div class="d-flex mt-2">
                                        <h5 class="font-weight-bolder">
                                            {{ $taping }}
                                        </h5>
                                        <p class="text-xs mb-0" style="margin-top: 5%;margin-left:3%"> Porsi</p>
                                    </div>
                                    <p class="d-flex mb-0">
                                        {{-- @if ($perTaping < 0)
                                            <span
                                                class="text-danger text-xs font-weight-bolder">{{ $perTaping }}%</span>
                                        @else
                                            <span
                                                class="text-success text-xs font-weight-bolder">+{{ $perTaping }}%</span>
                                        @endif --}}
                                        {{-- <span class="text-xs" style="margin-left: 3%"> dari tahun lalu</span> --}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fa-solid fa-file-lines text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Statistik Data Pesanan</h6>
                        <p class="text-sm mb-0">
                            Tahun
                            <span class="font-weight-bold text-dark">{{ $date->isoFormat('YYYY') }}</span>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-pesanan" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100 text-dark" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active">
                                <div class="d-flex card-header pb-0 pt-3 bg-transparent"
                                    style="padding-top: 1.5rem !important">
                                    <h6 class="text-capitalize">Menu Snack</h6>
                                    <h6> | </h6>
                                    <h6 class="text-muted">{{ $date->isoFormat('dddd, DD MMM YYYY') }}
                                    </h6>
                                </div>
                                <div class="card-body" style="max-height: 420px;overflow-y: auto;">
                                    <section class="" style="margin-left: 10%">
                                        <ul class="timeline-with-icons">
                                            @if (empty($groupedSnacks['Pagi']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Snack Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedSnacks['Pagi'] as $makanan)
                                                    @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                        <p class="text-muted mb-2 fw-bold text-xs">
                                                            {{ $indeks++ }}. {{ $makanan }}
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedSnacks['Siang']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Snack Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedSnacks['Siang'] as $makanan)
                                                    @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                        <p class="text-muted mb-2 fw-bold text-xs">
                                                            {{ $indeks++ }}. {{ $makanan }}
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedSnacks['Malam']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Snack Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedSnacks['Malam'] as $makanan)
                                                        @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                            <p class="text-muted mb-2 fw-bold text-xs">
                                                                {{ $indeks++ }}. {{ $makanan }}
                                                            </p>
                                                        @endforeach
                                                    @endforeach
                                                </li>
                                            @endif
                                        </ul>
                                    </section>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="d-flex card-header pb-0 pt-3 bg-transparent"
                                    style="padding-top: 1.5rem !important">
                                    <h6 class="text-capitalize">Menu Spesial</h6>
                                    <h6> | </h6>
                                    <h6 class="text-muted">{{ $date->isoFormat('dddd, DD MMM YYYY') }}
                                    </h6>
                                </div>
                                <div class="card-body" style="max-height: 420px;overflow-y: auto;">
                                    <section class="" style="margin-left: 10%">
                                        <ul class="timeline-with-icons">
                                            @if (empty($groupedMenus['Pagi']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Spesial Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedMenus['Malam'] as $makanan)
                                                    @php
                                                        $namaMakanan = json_decode($makanan->nama_makanan, true);
                                                    @endphp
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                1. Menu Spesial 1,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[0]}}
                                                            </p>
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                2. Menu Spesial 2,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[1]}}
                                                            </p>
                                                    @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedMenus['Siang']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Spesial Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedMenus['Siang'] as $makanan)
                                                    @php
                                                        $namaMakanan = json_decode($makanan->nama_makanan, true);
                                                    @endphp
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                1. Menu Spesial 1,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[0]}}
                                                            </p>
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                2. Menu Spesial 2,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[1]}}
                                                            </p>
                                                    @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedMenus['Malam']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Spesial Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    @foreach ($groupedMenus['Malam'] as $makanan)
                                                    @php
                                                        $namaMakanan = json_decode($makanan->nama_makanan, true);
                                                    @endphp
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                1. Menu Spesial 1,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[0]}}
                                                            </p>
                                                            <p class="text-dark mb-2 fw-bold text-xs">
                                                                2. Menu Spesial 2,5 Main Course
                                                            </p>
                                                            <p class="text-muted mb-2 fw-bold text-xs" style="margin-left: 4%">
                                                                {{$namaMakanan[1]}}
                                                            </p>
                                                    @endforeach
                                                </li>
                                            @endif
                                        </ul>
                                    </section>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="d-flex card-header pb-0 pt-3 bg-transparent"
                                    style="padding-top: 1.5rem !important">
                                    <h6 class="text-capitalize">Menu Reguler</h6>
                                    <h6> | </h6>
                                    <h6 class="text-muted">{{ $date->isoFormat('dddd, DD MMM YYYY') }}
                                    </h6>
                                </div>
                                <div class="card-body" style="max-height: 420px;overflow-y: auto;">
                                    <section class="" style="margin-left: 10%">
                                        <ul class="timeline-with-icons">
                                            @if (empty($groupedMenur['Pagi']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Reguler Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-mug-hot text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 05.00 -
                                                        11.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedMenur['Pagi'] as $makanan)
                                                    @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                        <p class="text-muted mb-2 fw-bold text-xs">
                                                            {{ $indeks++ }}. {{ $makanan }}
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedMenur['Siang']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Reguler Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-sun text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 11.00 -
                                                        17.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedMenur['Siang'] as $makanan)
                                                    @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                        <p class="text-muted mb-2 fw-bold text-xs">
                                                            {{ $indeks++ }}. {{ $makanan }}
                                                        </p>
                                                    @endforeach
                                                @endforeach
                                                </li>
                                            @endif
                                            @if (empty($groupedMenur['Malam']))
                                                <li class="timeline-item" style="margin-bottom: 10%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-danger mb-2 fw-bold text-sm">
                                                        Waktu : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    <p class="text-danger mb-2 fw-bold text-xs">
                                                        Menu Reguler Tidak Tersedia
                                                    </p>
                                                </li>
                                            @else
                                                <li class="timeline-item" style="margin-bottom: 8%">
                                                    <span class="timeline-icon">
                                                        <i class="fa-solid fa-moon text-primary fa-sm fa-fw"></i>
                                                    </span>
                                                    </h5>
                                                    <p class="text-dark mb-2 fw-bold text-sm">
                                                        Tersedia : 17.00 -
                                                        20.00 WIB
                                                    </p>
                                                    @php
                                                        $indeks = 1;
                                                    @endphp
                                                    @foreach ($groupedMenur['Malam'] as $makanan)
                                                        @foreach (json_decode($makanan->nama_makanan, true) as $makanan)
                                                            <p class="text-muted mb-2 fw-bold text-xs">
                                                                {{ $indeks++ }}. {{ $makanan }}
                                                            </p>
                                                        @endforeach
                                                    @endforeach
                                                </li>
                                            @endif
                                        </ul>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Statistik Data Makan</h6>
                        <p class="text-sm mb-0">
                            Tahun
                            <span class="font-weight-bold text-dark">{{ $date->isoFormat('YYYY') }}</span>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-taping" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" style="max-height: 420px">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        @if (Auth::user()->id_role === 4)
                            <h6 class="mb-0">Permintaan Pesanan Others</h6>
                        @else
                            <h6 class="mb-0">Pesanan Terakhir</h6>
                        @endif

                    </div>
                    <div class="card-body p-3" style="max-height: 420px;overflow-y: auto;">
                        <ul class="list-group">
                            @foreach ($pesananOthers as $order)
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        @if ($order->status == 'Menunggu')
                                            <div
                                                class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                                                <i class="fa-solid fa-m text-sm text-white opacity-10"></i>
                                            </div>
                                        @endif
                                        @if ($order->status == 'Diproses')
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center">
                                                <i class="fa-solid fa-d text-sm text-white opacity-10"></i>
                                            </div>
                                        @endif
                                        @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak')
                                            <div
                                                class="icon icon-shape icon-sm me-3 bg-gradient-danger shadow text-center">
                                                <i class="fa-solid fa-x text-sm text-white opacity-10"></i>
                                            </div>
                                        @endif
                                        @if ($order->status == 'Selesai')
                                            <div
                                                class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                                                <i class="fa-solid fa-s text-sm text-white opacity-10"></i>
                                            </div>
                                        @endif
                                        <div class="d-flex flex-column">
                                            <div class="d-flex">
                                                <h6 class="mb-1 text-dark text-sm">{{ $order->name }}</h6>
                                                <h6 class="mb-1 text-dark text-sm"> | </h6>
                                                <h6 class="mb-1 text-secondary text-sm">{{ $order->departemen }}</h6>
                                            </div>
                                            @php
                                                $tgl = json_decode($order->tanggal_pesanan,true);
                                                $tglPesanan1 = \Carbon\Carbon::parse($tgl[0]);
                                                $tglPesanan2 = \Carbon\Carbon::parse($tgl[1]);
                                            @endphp
                                            <span class="text-xs">Untuk <span
                                                    class="text-xs font-weight-bolder">{{ $tglPesanan1->isoFormat('ddd,DD MMM YYYY') }} - {{ $tglPesanan2->isoFormat('ddd,DD MMM YYYY') }}</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="/permintaan-pesanan?pesanan={{ $order->order_id }}"
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-pesanan").getContext("2d");
        var ctx2 = document.getElementById("chart-taping").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

        var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke2.addColorStop(1, 'rgba(245, 54, 92, 0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(245, 54, 92, 0.0)');
        gradientStroke2.addColorStop(0, 'rgba(245, 54, 92, 0)');

        var gradientStroke3 = ctx1.createLinearGradient(0, 230, 0, 50);
        gradientStroke3.addColorStop(1, 'rgba(17, 205, 239, 0.2)');
        gradientStroke3.addColorStop(0.2, 'rgba(17, 205, 239, 0.0)');
        gradientStroke3.addColorStop(0, 'rgba(17, 205, 239, 0)');

        var gradientStroke4 = ctx2.createLinearGradient(0, 230, 0, 50);
        gradientStroke4.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke4.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke4.addColorStop(0, 'rgba(94, 114, 228, 0)');

        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                        label: "Menu Spesial",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [
                            @foreach ($jumlahPesanan as $jumlah)
                                {{ $jumlah[0] }},
                            @endforeach
                        ],
                        maxBarThickness: 6

                    }, {
                        label: "Snack", // Label untuk garis kedua
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#f5365c", // Warna untuk garis kedua
                        backgroundColor: gradientStroke2, // Gradient (jika diperlukan)
                        borderWidth: 3,
                        fill: true,
                        data: [
                            @foreach ($jumlahPesanan as $jumlah)
                                {{ $jumlah[1] }},
                            @endforeach
                        ], // Data untuk garis kedua
                        maxBarThickness: 6
                    },
                    {
                        label: "Others", // Label untuk garis ketiga
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#11cdef", // Warna untuk garis ketiga
                        backgroundColor: gradientStroke3, // Gradient (jika diperlukan)
                        borderWidth: 3,
                        fill: true,
                        data: [
                            @foreach ($jumlahPesanan as $jumlah)
                                {{ $jumlah[2] }},
                            @endforeach
                        ], // Data untuk garis ketiga
                        maxBarThickness: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: "Prasmanan",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [
                        @foreach ($jumlahTaping as $jumlah)
                            {{ $jumlah[0] }},
                        @endforeach
                    ],
                    maxBarThickness: 6
                }, {
                    label: "Packmeal", // Label untuk garis kedua
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#f5365c", // Warna untuk garis kedua
                    backgroundColor: gradientStroke2, // Gradient (jika diperlukan)
                    borderWidth: 3,
                    fill: true,
                    data: [
                        @foreach ($jumlahTaping as $jumlah)
                            {{ $jumlah[1] }},
                        @endforeach
                    ], // Data untuk garis kedua
                    maxBarThickness: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endsection
