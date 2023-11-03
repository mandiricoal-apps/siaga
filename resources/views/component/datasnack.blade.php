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
</style>
<!-- End Navbar -->
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
                        <p class="text-xxs">{{ $date->isoFormat('DD MMM YYYY') }}</p>
                    </div>
                    <div class="card-body">
                        <section class="" style="margin-left: 10%">
                            <ul class="timeline-with-icons">
                                @foreach ($groupedSnacks as $shift => $snacksInShift)
                                    @php
                                        $makananShiftTersedia = false; // Inisialisasi variabel
                                    @endphp
                                    @foreach ($snacksInShift as $snack)
                                        @php
                                            $carbonDate = \Carbon\Carbon::parse($snack->tanggal_berlaku);
                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                        @endphp
                                        @if ($dayOfWeek == array_search($i, [-1, 0, 1, 2, 3, 4, 5]) && $snack->shift == $shift)
                                            <li class="timeline-item mb-4">
                                                <a type="button" class="" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $snack->id }}">
                                                    <span class="timeline-icon">
                                                        @if ($snack->shift == 'Pagi')
                                                            <i
                                                                class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                        @endif
                                                        @if ($snack->shift == 'Siang')
                                                            <i class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                        @endif
                                                        @if ($snack->shift == 'Malam')
                                                            <i class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                        @endif
                                                    </span>

                                                    <h5 class="fw-bold text-xs">{{ $snack->nama_makanan }}</h5>
                                                    @if ($snack->shift == 'Pagi')
                                                        <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 08.00 -
                                                            12.00 WIB
                                                        </p>
                                                    @endif
                                                    @if ($snack->shift == 'Siang')
                                                        <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 12.00 -
                                                            17.00 WIB
                                                        </p>
                                                    @endif
                                                    @if ($snack->shift == 'Malam')
                                                        <p class="text-muted mb-2 fw-bold text-xs">Tersedia : 17.00 -
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

                                            <div class="modal fade" id="exampleModal{{ $snack->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content m-5">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Detail
                                                                Snack</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Nama Snack</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{$snack->nama_makanan}}
                                                                </p>

                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg  text-dark">Tanggal Berlaku</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @php
                                                                        $tgl = $snack->tanggal_berlaku;
                                                                        $timestamp = strtotime($tgl);
                                                                        $formattedDate = date('d F Y', $timestamp)
                                                                    @endphp
                                                                    {{ $formattedDate }}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Waktu Pesanan</p>
                                                                @if ($snack->shift == 'Pagi')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        07.00 - 12.00 WIB </p>
                                                                @endif
                                                                @if ($snack->shift == 'Siang')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        12.00 - 17.00 WIB </p>
                                                                @endif
                                                                @if ($snack->shift == 'Malam')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        17.00 - 20.00 WIB </p>
                                                                @endif
                                                            </div>
                                                            <div class="row justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Deskripsi</p>
                                                                <p class="text-muted mb-0 text-md">{{ $snack->deskripsi }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
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
                                                    <i class="fa-solid fa-mug-hot text-primary fa-xs fa-fw"></i>
                                                @endif
                                                @if ($snack->shift == 'Siang')
                                                    <i class="fa-solid fa-sun text-primary fa-xs fa-fw"></i>
                                                @endif
                                                @if ($snack->shift == 'Malam')
                                                    <i class="fa-solid fa-moon text-primary fa-xs fa-fw"></i>
                                                @endif
                                            </span>
                                            @if ($snack->shift == 'Pagi')
                                                <p class="text-xs text-danger" style="font-style: italic">
                                                    Menu Snack Belum Tersedia pada Waktu 07.00 - 12.00 WIB.
                                                </p>
                                            @endif
                                            @if ($snack->shift == 'Siang')
                                                <p class="text-xs text-danger" style="font-style: italic">
                                                    Menu Snack Belum Tersedia pada Waktu 12.00 - 15.00 WIB.
                                                </p>
                                            @endif
                                            @if ($snack->shift == 'Malam')
                                                <p class="text-xs text-danger" style="font-style: italic">
                                                    Menu Snack Belum Tersedia pada Waktu 15.00 - 18.00 WIB.
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
