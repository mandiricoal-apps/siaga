<!-- Navbar -->
<style>
    .timeline-with-icons {
        border-left: 1px solid hsl(0, 0%, 90%);
        list-style: none;
    }

    .timeline-with-icons .timeline-item {
        position: relative;
    }


    .timeline-with-icons .timeline-icon {
        position: absolute;
        left: -48px;
        background-color: hsl(217, 88.2%, 90%);
        color: hsl(217, 88.8%, 35.1%);
        border-radius: 50%;
        height: 25px;
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .timeline-item:hover {
        /* Your hover styles here */
        background-color: #f0f0f0;
        cursor: pointer;
        border-radius: 10%
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
<!-- End Navbar -->
<div class="container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-12 mb-2">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#jadwal-snacks" role="tab"
                            aria-controls="snacks" aria-selected="true">
                            Jadwal Snack
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#jadwal-menus" role="tab"
                            aria-controls="menus" aria-selected="false">
                            Jadwal Menu Spesial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#jadwal-menur" role="tab"
                            aria-controls="menur" aria-selected="false">
                            Jadwal Menu Reguler
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="jadwal-snacks" role="tabpanel"aria-labelledby="snacks">
                        <div class="container-fluid py-4 mt-2">
                            <div class="row justify-content-center ">
                                @foreach (range(0, 6) as $i)
                                    @php
                                        $date = now()
                                            ->startOfWeek()
                                            ->addDays($i);
                                        $makananDitemukan = false;
                                    @endphp
                                    <div class="col-md-3 mt-3">
                                        <div class="card card-profile" style="min-height: 100%">
                                            <div class="card-header pb-0">
                                                <p class="text-sm text-dark fw-bold">
                                                    {{ $date->isoFormat('dddd, DD MMMM YYYY') }}</p>
                                            </div>
                                            <div class="card-body">
                                                <section class="" style="margin-left: 10%">
                                                    <ul class="timeline-with-icons">
                                                        @foreach ($groupedSnacks as $shift => $snacksInShift)
                                                            @php
                                                                $makananShiftTersedia = false;
                                                            @endphp
                                                            @foreach ($snacksInShift as $snack)
                                                                @php
                                                                    $carbonDate = \Carbon\Carbon::parse($snack->tanggal_berlaku);
                                                                    $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                                @endphp
                                                                @if ($dayOfWeek == array_search($i, [-1, 0, 1, 2, 3, 4, 5]) && $snack->shift == $shift)
                                                                    <li class="timeline-item mb-4">
                                                                        <a type="button" class=""
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal{{ $snack->id }}">
                                                                            <span class="timeline-icon">
                                                                                @if ($snack->shift == 'Pagi')
                                                                                    <i
                                                                                        class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($snack->shift == 'Siang')
                                                                                    <i
                                                                                        class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($snack->shift == 'Malam')
                                                                                    <i
                                                                                        class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                            </span>

                                                                            <h5 class="fw-bold text-xs">Snack Tersedia
                                                                            </h5>
                                                                            @if ($snack->shift == 'Pagi')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 05.00 -
                                                                                    11.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($snack->shift == 'Siang')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 11.00 -
                                                                                    17.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($snack->shift == 'Malam')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 17.00 -
                                                                                    20.00 WIB
                                                                                </p>
                                                                            @endif

                                                                            {{-- <p class="text-muted text-xs">
                                                                            {{ $snack->deskripsi }}
                                                                        </p> --}}
                                                                        </a>
                                                                    </li>

                                                                    @php
                                                                        $makananShiftTersedia = true;
                                                                    @endphp

                                                                    <div class="modal fade"
                                                                        id="exampleModal{{ $snack->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered"
                                                                            role="document">
                                                                            <div class="modal-content m-5">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title"
                                                                                        id="exampleModalLabel">Detail
                                                                                        Snack</h4>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg  text-dark">
                                                                                            Tanggal
                                                                                            Berlaku</p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md">
                                                                                            @php
                                                                                                $tgl = $snack->tanggal_berlaku;
                                                                                                $timestamp = strtotime($tgl);
                                                                                                $formattedDate = date('d F Y', $timestamp);
                                                                                            @endphp
                                                                                            {{ $formattedDate }}</p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Waktu Pesanan
                                                                                        </p>
                                                                                        @if ($snack->shift == 'Pagi')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                05.00 - 11.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($snack->shift == 'Siang')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                11.00 - 17.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($snack->shift == 'Malam')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                17.00 - 20.00 WIB </p>
                                                                                        @endif
                                                                                    </div>
                                                                                    @php
                                                                                        $makanan = json_decode($snack->nama_makanan, true);
                                                                                        $no = 1;
                                                                                    @endphp
                                                                                    <div
                                                                                        class="justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Snack Tersedia
                                                                                        </p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md">
                                                                                            @foreach ($makanan as $item)
                                                                                                {{ $no++ }}.
                                                                                                {{ $item }} <br>
                                                                                            @endforeach
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn bg-gradient-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @if (!$makananShiftTersedia)
                                                                <li class="timeline-item mb-4">
                                                                    <span class="timeline-icon">
                                                                        @if ($snack->shift == 'Pagi')
                                                                            <i
                                                                                class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                        @endif
                                                                        @if ($snack->shift == 'Siang')
                                                                            <i
                                                                                class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                        @endif
                                                                        @if ($snack->shift == 'Malam')
                                                                            <i
                                                                                class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                        @endif
                                                                    </span>
                                                                    @if ($snack->shift == 'Pagi')
                                                                        <p class="text-xs text-danger"
                                                                            style="font-style: italic">
                                                                            Menu Snack Belum Tersedia pada Waktu 05.00 -
                                                                            11.00 WIB.
                                                                        </p>
                                                                    @endif
                                                                    @if ($snack->shift == 'Siang')
                                                                        <p class="text-xs text-danger"
                                                                            style="font-style: italic">
                                                                            Menu Snack Belum Tersedia pada Waktu 11.00 -
                                                                            17.00 WIB.
                                                                        </p>
                                                                    @endif
                                                                    @if ($snack->shift == 'Malam')
                                                                        <p class="text-xs text-danger"
                                                                            style="font-style: italic">
                                                                            Menu Snack Belum Tersedia pada Waktu 17.00 -
                                                                            20.00 WIB.
                                                                        </p>
                                                                    @endif


                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </section>
                                            </div>
                                            <!-- Section: Timeline -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="jadwal-menus" role="tabpanel"aria-labelledby="menus">
                        <div class="container-fluid py-4 mt-2">
                            <div class="row justify-content-center">
                                @foreach (range(0, 6) as $i)
                                    @php
                                        $date = now()
                                            ->startOfWeek()
                                            ->addDays($i);
                                        $makananDitemukan = false;
                                    @endphp
                                    <div class="col-md-3 mt-3">
                                        <div class="card card-profile" style="min-height: 100%">
                                            <div class="card-header pb-0">
                                                <p class="text-sm fw-bold text-dark">
                                                    {{ $date->isoFormat('dddd, DD MMMM YYYY') }}</p>
                                            </div>
                                            <div class="card-body">
                                                <section class="" style="margin-left: 10%">
                                                    <ul class="timeline-with-icons">
                                                        @foreach ($groupedMenus as $shift => $menusInShift)
                                                            @php
                                                                $makananShiftTersedia = false; // Inisialisasi variabel
                                                            @endphp
                                                            @foreach ($menusInShift as $menu)
                                                                @php
                                                                    $carbonDate = \Carbon\Carbon::parse($menu->tanggal_berlaku);
                                                                    $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                                @endphp
                                                                @if ($dayOfWeek == array_search($i, [-1, 0, 1, 2, 3, 4, 5]) && $menu->shift == $shift)
                                                                    <li class="timeline-item mb-4">
                                                                        <a type="button" class=""
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#menusModal{{ $menu->id }}">
                                                                            <span class="timeline-icon">
                                                                                @if ($menu->shift == 'Pagi')
                                                                                    <i
                                                                                        class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($menu->shift == 'Siang')
                                                                                    <i
                                                                                        class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($menu->shift == 'Malam')
                                                                                    <i
                                                                                        class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                            </span>

                                                                            <h5 class="fw-bold text-xs">Menu Tersedia
                                                                            </h5>
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 05.00 -
                                                                                    11.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 11.00 -
                                                                                    17.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 17.00 -
                                                                                    20.00 WIB
                                                                                </p>
                                                                            @endif

                                                                            {{-- <p class="text-muted text-xs">
                                                                            {{ $menu->deskripsi }}
                                                                        </p> --}}
                                                                        </a>
                                                                    </li>

                                                                    @php
                                                                        $makananShiftTersedia = true;
                                                                    @endphp

                                                                    <div class="modal fade"
                                                                        id="menusModal{{ $menu->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered"
                                                                            role="document">
                                                                            <div class="modal-content m-5">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title"
                                                                                        id="exampleModalLabel">Detail
                                                                                        Menu</h4>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg  text-dark">
                                                                                            Tanggal
                                                                                            Berlaku</p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md">
                                                                                            @php
                                                                                                $tgl = $menu->tanggal_berlaku;
                                                                                                $timestamp = strtotime($tgl);
                                                                                                $formattedDate = date('d F Y', $timestamp);
                                                                                            @endphp
                                                                                            {{ $formattedDate }}</p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Waktu Pesanan
                                                                                        </p>
                                                                                        @if ($menu->shift == 'Pagi')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                05.00 - 11.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($menu->shift == 'Siang')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                11.00 - 17.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($menu->shift == 'Malam')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                17.00 - 20.00 WIB </p>
                                                                                        @endif
                                                                                    </div>
                                                                                    @php
                                                                                        $makanan = json_decode($menu->nama_makanan, true);
                                                                                        $no = 1;
                                                                                    @endphp
                                                                                    <div
                                                                                        class="justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Menu Tersedia
                                                                                        </p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md fw-bold">
                                                                                            {{ $no }}. Menu
                                                                                            Spesial 1,5 main course
                                                                                        </p>
                                                                                        <p class="text-muted mb-0 text-md"
                                                                                            style="margin-left: 5%">
                                                                                            {{ $makanan[0] }}
                                                                                        </p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md fw-bold">
                                                                                            {{ $no + 1 }}. Menu
                                                                                            Spesial 2,5 main course
                                                                                        </p>
                                                                                        <p class="text-muted mb-0 text-md"
                                                                                            style="margin-left: 5%">
                                                                                            {{ $makanan[1] }}
                                                                                        </p>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn bg-gradient-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @if (!$makananShiftTersedia)
                                                                <li class="timeline-item mb-4">
                                                                    <a type="button" class="">
                                                                        <span class="timeline-icon">
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <i
                                                                                    class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <i
                                                                                    class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <i
                                                                                    class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                        </span>
                                                                        @if ($menu->shift == 'Pagi')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Spesial Belum Tersedia pada Waktu
                                                                                05.00
                                                                                - 11.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                        @if ($menu->shift == 'Siang')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Spesial Belum Tersedia pada Waktu
                                                                                11.00
                                                                                - 17.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                        @if ($menu->shift == 'Malam')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Spesial Belum Tersedia pada Waktu
                                                                                17.00
                                                                                - 20.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        {{-- <li class="timeline-item mb-4">

                                                            <span class="timeline-icon">
                                                                <i class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                            </span>
                                                            <h5 class="fw-bold text-xs">Risol</h5>
                                                            <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 12.00 - 17.00 WIB</p>
                                                            <p class="text-muted text-xs">
                                                                Deksripsi
                                                            </p>
                                                        </li>

                                                        <li class="timeline-item mb-4">

                                                            <span class="timeline-icon">
                                                                <i class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                            </span>
                                                            <h5 class="fw-bold text-xs">Risol</h5>
                                                            <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 17.00 - 20.00 WIB</p>
                                                            <p class="text-muted text-xs">
                                                                Deksripsi
                                                            </p>
                                                        </li> --}}
                                                    </ul>
                                                </section>
                                            </div>
                                            <!-- Section: Timeline -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="jadwal-menur" role="tabpanel"aria-labelledby="menur">
                        <div class="container-fluid py-4 mt-3">
                            <div class="row justify-content-center">
                                @foreach (range(0, 6) as $i)
                                    @php
                                        $date = now()
                                            ->startOfWeek()
                                            ->addDays($i);
                                        $makananDitemukan = false;
                                    @endphp
                                    <div class="col-md-3 mt-3">
                                        <div class="card card-profile" style="min-height: 100%">
                                            <div class="card-header pb-0">
                                                <p class="text-md fw-bold text-dark">
                                                    {{ $date->isoFormat('dddd, DD MMMM YYYY') }}</p>
                                            </div>
                                            <div class="card-body">
                                                <section class="" style="margin-left: 10%">
                                                    <ul class="timeline-with-icons">
                                                        @foreach ($groupedMenur as $shift => $menusInShift)
                                                            @php
                                                                $makananShiftTersedia = false; // Inisialisasi variabel
                                                            @endphp
                                                            @foreach ($menusInShift as $menu)
                                                                @php
                                                                    $carbonDate = \Carbon\Carbon::parse($menu->tanggal_berlaku);
                                                                    $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                                @endphp
                                                                @if ($dayOfWeek == array_search($i, [-1, 0, 1, 2, 3, 4, 5]) && $menu->shift == $shift)
                                                                    <li class="timeline-item mb-4">
                                                                        <a type="button" class=""
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#menur{{ $menu->id }}">
                                                                            <span class="timeline-icon">
                                                                                @if ($menu->shift == 'Pagi')
                                                                                    <i
                                                                                        class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($menu->shift == 'Siang')
                                                                                    <i
                                                                                        class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                                @if ($menu->shift == 'Malam')
                                                                                    <i
                                                                                        class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                                @endif
                                                                            </span>

                                                                            <h5 class="fw-bold text-xs">Menu Tersedia
                                                                            </h5>
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 05.00 -
                                                                                    11.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 11.00 -
                                                                                    17.00 WIB
                                                                                </p>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <p
                                                                                    class="text-muted mb-2 fw-bold text-xs">
                                                                                    Tersedia : 17.00 -
                                                                                    20.00 WIB
                                                                                </p>
                                                                            @endif

                                                                            {{-- <p class="text-muted text-xs">
                                                                            {{ $menu->deskripsi }}
                                                                        </p> --}}
                                                                        </a>
                                                                    </li>

                                                                    @php
                                                                        $makananShiftTersedia = true;
                                                                    @endphp

                                                                    <div class="modal fade"
                                                                        id="menur{{ $menu->id }}" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered"
                                                                            role="document">
                                                                            <div class="modal-content m-5">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title"
                                                                                        id="exampleModalLabel">Detail
                                                                                        Menu</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    @php
                                                                                        $makanan = json_decode($menu->nama_makanan, true);
                                                                                        $no = 1;
                                                                                    @endphp
                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg  text-dark">
                                                                                            Tanggal
                                                                                            Berlaku</p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md">
                                                                                            @php
                                                                                                $tgl = $menu->tanggal_berlaku;
                                                                                                $timestamp = strtotime($tgl);
                                                                                                $formattedDate = date('d F Y', $timestamp);
                                                                                            @endphp
                                                                                            {{ $formattedDate }}</p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Waktu Pesanan
                                                                                        </p>
                                                                                        @if ($menu->shift == 'Pagi')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                05.00 - 11.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($menu->shift == 'Siang')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                11.00 - 17.00 WIB </p>
                                                                                        @endif
                                                                                        @if ($menu->shift == 'Malam')
                                                                                            <p
                                                                                                class="text-muted mb-0 text-md">
                                                                                                17.00 - 20.00 WIB </p>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div
                                                                                        class="justify-content-between mb-3">
                                                                                        <p
                                                                                            class="fw-bold mb-0 text-lg text-dark">
                                                                                            Menu Tersedia
                                                                                        </p>
                                                                                        <p
                                                                                            class="text-muted mb-0 text-md">
                                                                                            @foreach ($makanan as $item)
                                                                                                {{ $no++ }}.
                                                                                                {{ $item }}
                                                                                                <br>
                                                                                            @endforeach
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn bg-gradient-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            @if (!$makananShiftTersedia)
                                                                <li class="timeline-item mb-4">
                                                                    <a type="button" class="">
                                                                        <span class="timeline-icon">
                                                                            @if ($menu->shift == 'Pagi')
                                                                                <i
                                                                                    class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                            @if ($menu->shift == 'Siang')
                                                                                <i
                                                                                    class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                            @if ($menu->shift == 'Malam')
                                                                                <i
                                                                                    class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                                            @endif
                                                                        </span>
                                                                        @if ($menu->shift == 'Pagi')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Reguler Belum Tersedia pada Waktu
                                                                                05.00 - 11.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                        @if ($menu->shift == 'Siang')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Reguler Belum Tersedia pada Waktu
                                                                                11.00 - 17.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                        @if ($menu->shift == 'Malam')
                                                                            <p class="text-xs text-danger"
                                                                                style="font-style: italic">
                                                                                Menu Reguler Belum Tersedia pada Waktu
                                                                                17.00 - 20.00 WIB.
                                                                            </p>
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        {{-- <li class="timeline-item mb-4">

                                                            <span class="timeline-icon">
                                                                <i class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                            </span>
                                                            <h5 class="fw-bold text-xs">Risol</h5>
                                                            <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 12.00 - 17.00 WIB</p>
                                                            <p class="text-muted text-xs">
                                                                Deksripsi
                                                            </p>
                                                        </li>

                                                        <li class="timeline-item mb-4">

                                                            <span class="timeline-icon">
                                                                <i class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                            </span>
                                                            <h5 class="fw-bold text-xs">Risol</h5>
                                                            <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 17.00 - 20.00 WIB</p>
                                                            <p class="text-muted text-xs">
                                                                Deksripsi
                                                            </p>
                                                        </li> --}}
                                                    </ul>
                                                </section>
                                            </div>
                                            <!-- Section: Timeline -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
