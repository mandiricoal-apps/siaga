@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Menu;
@endphp
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />

<!-- Add the SweetAlert2 stylesheet link in the head section of your HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

<!-- Add the SweetAlert2 script link at the end of the body section of your HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- css untuk select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css"
    integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Mengubah warna teks di pagination */
    .pagination .page-item .page-link {
        color: black;
        /* Ganti dengan warna yang Anda inginkan */
    }

    /* Mengubah warna teks pada tombol aktif di pagination */
    .pagination .page-item.active .page-link {
        background-color: #7b5e50;
        border-color: #7b5e50;
        color: white;
        /* Ganti dengan warna yang Anda inginkan */
    }
</style>

@if (session('error'))
    <script>
        // Tampilkan pesan error dalam pop-up
        Swal.fire({
            icon: 'error',
            title: 'Tidak Berhasil',
            text: '{{ session('error') }}', // Ambil pesan error dari session
        });
    </script>
@endif
@if (session('success'))
    <script>
        // Tampilkan pesan error dalam pop-up
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}', // Ambil pesan error dari session
        });
    </script>
@endif

<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card-header pb-0">
                <div class=" align-items-center">
                    <a class="btn btn-sm ms-auto bg-gradient-success" type="button" class=""
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-plus" style="margin-right: 10px"></i>Buat Pesanan</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Riwayat Pesanan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('export.datamakan', request()->query()) }}" method="GET"
                        id="filter-taping">
                        {{-- <p for="example-text-input" class="text-md text-center">Filter Data Taping</p> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label dateselect"><span
                                            class="text-xxs" style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                        Awal</label>
                                    <input class="form-control bg-white" type="date" placeholder="yyyy-mm-dd"
                                        id="min" name="min" data-input required>
                                    @if ($errors->has('min '))
                                        <span class="text-danger text-xs">{{ $errors->first('min') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label dateselect"><span
                                            class="text-xxs" style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                        Akhir</label>
                                    <input class="form-control bg-white" type="date" placeholder="yyyy-mm-dd"
                                        id="max" name="max" required>
                                    @if ($errors->has('max'))
                                        <span class="text-danger text-xs">{{ $errors->first('max') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <label for="example-text-input"
                                    class="form-control-label dateselect col-12"></label>
                                <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                    onclick="dataExport()">
                                    <i class="text-sm fa-solid fa-file-excel"
                                        style="margin-right: 10px"></i>Export to
                                    Excel</a>
                                <script>
                                    // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                    function dataExport() {
                                        document.getElementById('filter-taping').submit();
                                    }
                                </script>
                            </div> --}}
                            <script>
                                $("#min, #max").flatpickr({
                                    dateFormat: "Y-m-d"
                                });
                            </script>
                        </div>
                    </form>
                    <hr class="horizontal dark">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="riwayat_pes">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Menu</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah Porsi Pesanan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Pemesan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pemesanan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Pesanan</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $order->jenis_pesanan }}</span>
                                        </td>
                                        @php
                                            $detail_menu = json_decode($order->makanan, true);
                                            $detail_porsi = json_decode($order->jumlah_pesanan, true);
                                            $total_porsi = array_sum($detail_porsi);
                                            $kirim = json_decode($order->tanggal_pesanan, true);
                                        @endphp

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $total_porsi }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ Auth::user()->name }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $order->created_at }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $kirim[0] }} <b
                                                    class="text-dark text-lg"> - </b> {{ $kirim[1] }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($order->status == 'Selesai')
                                                <span class="badge badge-sm bg-gradient-success"
                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                            @endif
                                            @if ($order->status == 'Menunggu')
                                                <span class="badge badge-sm bg-gradient-warning"
                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                            @endif
                                            @if ($order->status == 'Diproses')
                                                <span class="badge badge-sm bg-gradient-info"
                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                            @endif
                                            @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                <span class="badge badge-sm bg-gradient-danger"
                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a type="button"
                                                class="fa-solid fa-eye text-s badge badge-md text-dark mt-3"
                                                data-toggle="tooltip" data-original-title="Detail"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailPesanan{{ $order->order_id }}"
                                                style="border: solid 1px">
                                            </a>
                                            @if ($order->status == 'Dibatalkan' || $order->status == 'Selesai' || $order->status == 'Ditolak' || $order->status == 'Diproses' || $order->status == 'Kadaluwarsa')
                                                <button
                                                    class="text-s badge badge-md bg-gradient-secondary fa-solid fa-square-pen"
                                                    data-toggle="tooltip" data-original-title="Edit" disabled>

                                                </button>
                                                <button type="button"
                                                    class="badge badge-md bg-gradient-secondary fa-solid fa-xmark"
                                                    data-toggle="tooltip" data-original-title="Hapus"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#cancelPesanan{{ $order->order_id }}" disabled>
                                                </button>
                                            @else
                                                <a href="ubah-pesanan/{{ $order->order_id }}"
                                                    class=" btn badge badge-md text-dark fa-solid fa-square-pen"
                                                    data-toggle="tooltip" data-original-title="Edit"
                                                    style="border: solid 1px">
                                                </a>
                                                <a type="button"
                                                    class="btn badge badge-md text-dark fa-solid fa-xmark"
                                                    data-toggle="tooltip" data-original-title="Hapus"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#cancelPesanan{{ $order->order_id }}"
                                                    style="border: solid 1px">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade modal-xl " id="detailPesanan{{ $order->order_id }}"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content m-5">
                                                <div class="d-flex modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel">Detail
                                                        Pesanan</h4>

                                                    {{-- @if ($user->status == 'Aktif')
                                                        <p class="badge badge-sm text-xxs bg-gradient-success m-1"
                                                            style="width: 30%; height: 100%;">
                                                            {{ $user->status }}</p>
                                                    @else
                                                        <p class="badge badge-sm text-xxs bg-gradient-danger"
                                                            style="width: 30%; height: 100%;">
                                                            {{ $user->status }}</p>
                                                    @endif --}}
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex row">
                                                        <div class="col md 6">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Status
                                                                    Pesanan
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @if ($order->status == 'Selesai')
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                                                    @endif
                                                                    @if ($order->status == 'Menunggu')
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                                                    @endif
                                                                    @if ($order->status == 'Diproses')
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-info">{{ $order->status }}</span>
                                                                    @endif
                                                                    @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak' || $order->status == 'Kadaluwarsa')
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-danger">{{ $order->status }}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Nama Pemesan
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $order->name }}
                                                                </p>

                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg  text-dark">Jenis Menu
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $order->jenis_pesanan }}
                                                                </p>
                                                            </div>
                                                            @php

                                                                $kirim = json_decode($order->tanggal_pesanan, true);
                                                                foreach ($kirim as $tglPess) {
                                                                    $tgl[] = \Carbon\Carbon::parse($tglPess);
                                                                }
                                                                $waktu = \Carbon\Carbon::parse($order->waktu_pesanan);
                                                                $num = 1;
                                                            @endphp

                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Tanggal
                                                                    Pemesanan</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $order->created_at->isoFormat('DD MMMM Y') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Tanggal
                                                                    Pengiriman
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $tgl[0]->isoFormat('DD MMM Y') }} -
                                                                    {{ $tgl[1]->isoFormat('DD MMM Y') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Jam
                                                                    Pengiriman
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $waktu->format('h:i A') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Lokasi
                                                                    Pengantaran
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $order->lokasi_pengantaran }}
                                                                </p>
                                                            </div>
                                                            <div class="justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Nama Peserta
                                                                </p>
                                                                @php
                                                                    $data_peserta = explode(',', $order->detail_karyawan);
                                                                @endphp

                                                                @foreach ($data_peserta as $item)
                                                                    {{ $item }} <br>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" style="margin-left: 5%">
                                                            <div class="justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Menu Makanan
                                                                </p>
                                                                <div style="max-height: 300px; overflow-y: auto;">
                                                                    @if ($order->jenis_pesanan == 'Menu Spesial')
                                                                        @php
                                                                            $menu = json_decode($order->id_menu, true);
                                                                            $menus = Menu::whereIn('id', $menu)
                                                                                ->orderBy('tanggal_berlaku', 'asc')
                                                                                ->get();
                                                                            $k = 0;
                                                                            $i = 0;

                                                                        @endphp
                                                                        @foreach ($menus as $namaMenu)
                                                                            @php
                                                                                $indeksMenu = 0;
                                                                                $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                            @endphp
                                                                            <b
                                                                                class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                            <br>

                                                                            <span class="text-muted"
                                                                                style="margin-bottom: 7%">
                                                                                <p class="text-sm"
                                                                                    style="margin-bottom: auto">1,5
                                                                                    Main Course</p>
                                                                                <b
                                                                                    class="">{{ $nmakanan[0] }}</b>
                                                                                :
                                                                                <b
                                                                                    class="">{{ $detail_porsi[$i] }}</b>
                                                                                porsi
                                                                                <br>
                                                                                @php
                                                                                    $k++;
                                                                                    $i++;
                                                                                @endphp
                                                                                <p class="text-sm"
                                                                                    style="margin-bottom: auto">2,5
                                                                                    Main Course</p>
                                                                                <b
                                                                                    class="">{{ $nmakanan[1] }}</b>
                                                                                :
                                                                                <b
                                                                                    class="">{{ $detail_porsi[$i] }}</b>
                                                                                porsi
                                                                                <br>
                                                                                @php
                                                                                    $k++;
                                                                                    $i++;
                                                                                @endphp
                                                                            </span>
                                                                            <br>
                                                                        @endforeach
                                                                    @endif
                                                                    @if ($order->jenis_pesanan == 'Snack')
                                                                        @php
                                                                            $menu = json_decode($order->id_menu, true);
                                                                            $menus = Menu::whereIn('id', $menu)
                                                                                ->orderBy('tanggal_berlaku', 'asc')
                                                                                ->get();
                                                                            $k = 0;
                                                                            $i = 0;
                                                                        @endphp

                                                                        @foreach ($menus as $namaMenu)
                                                                            @php
                                                                                $indeksMenu = 0;
                                                                                $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                            @endphp
                                                                            <b
                                                                                class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                            <br>
                                                                            @foreach ($nmakanan as $nm)
                                                                                <span class="text-muted mb-5">
                                                                                    <b
                                                                                        class="text-dark">{{ $nm }}</b>
                                                                                    :
                                                                                    <b
                                                                                        class="text-dark">{{ $detail_porsi[$i] }}</b>
                                                                                    porsi
                                                                                </span>
                                                                                @if (count($detail_porsi) == 1)
                                                                                @else
                                                                                    @if ($i < count($detail_porsi) - 1)
                                                                                        <br>
                                                                                    @else
                                                                                    @endif
                                                                                @endif
                                                                                @php
                                                                                    $k++;
                                                                                    $i++;
                                                                                    $indeksMenu++;
                                                                                @endphp
                                                                            @endforeach
                                                                            <br>
                                                                        @endforeach
                                                                    @endif
                                                                    @if ($order->jenis_pesanan == 'Others')
                                                                        @php
                                                                            $kirim = json_decode($order->tanggal_pesanan, true);
                                                                            $tanggalAwal = new DateTime($kirim[0]);
                                                                            $tanggalAkhir = new DateTime($kirim[1]);

                                                                            $tanggalAkhir->modify('+1 day');

                                                                            $interval = new DateInterval('P1D'); // Interval 1 hari
                                                                            $daterange = new DatePeriod($tanggalAwal, $interval, $tanggalAkhir);
                                                                            $k = 0;
                                                                            $i = 0;
                                                                            $namaMakanan = json_decode($order->makanan, true);
                                                                        @endphp

                                                                        @foreach ($daterange as $tglPes)
                                                                            @php
                                                                                $indeksMenu = 0;
                                                                                $tanggalPes = $tglPes->format('Y-m-d');
                                                                                $pesanDate = \Carbon\Carbon::parse($tanggalPes);
                                                                                // $nmakanan = json_decode($namaMenu->nama_makanan, true);
                                                                                // $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                                            @endphp
                                                                            <b
                                                                                class="text-dark">{{ $pesanDate->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                                            <br>
                                                                            <span class="text-muted mb-5">
                                                                                <b
                                                                                    class="text-dark">{{ $namaMakanan[$i] }}</b>
                                                                                :
                                                                                <b
                                                                                    class="text-dark">{{ $detail_porsi[$k] }}</b>
                                                                                porsi
                                                                            </span>
                                                                            @if (count($detail_porsi) == 1)
                                                                            @else
                                                                                @if ($k < count($detail_porsi) - 1)
                                                                                    <br>
                                                                                @else
                                                                                @endif
                                                                            @endif
                                                                            @php
                                                                                $k++;
                                                                                $i++;
                                                                            @endphp
                                                                            <br>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="horizontal dark">
                                                        <div class="col-md-4">
                                                            <div class="justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark ">Alasan
                                                                    Pemesanan
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $order->alasan_pemesanan }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark ">Catatan
                                                                    Pemesanan
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @if ($order->catatan == null)
                                                                        <div class="text-sm text-danger"
                                                                            style="font-style: italic">
                                                                            Kosong
                                                                        </div>
                                                                    @else
                                                                        {{ $order->catatan }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @if ($order->status == 'Dibatalkan')
                                                            <div class="col-md-4">
                                                                <div class="justify-content-between mb-3">
                                                                    <p class="fw-bold mb-0 text-lg text-dark ">Alasan
                                                                        Pembatalan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        @if ($order->alasan == null)
                                                                            <div class="text-sm text-danger"
                                                                                style="font-style: italic">
                                                                                Kosong
                                                                            </div>
                                                                        @else
                                                                            {{ $order->alasan }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($order->status == 'Ditolak')
                                                            <div class="col-md-4">
                                                                <div class="justify-content-between mb-3">
                                                                    <p class="fw-bold mb-0 text-lg text-dark ">Alasan
                                                                        Penolakan
                                                                    </p>
                                                                    <p class="text-muted mb-0 text-md">
                                                                        @if ($order->alasan == null)
                                                                            <div class="text-sm text-danger"
                                                                                style="font-style: italic">
                                                                                Kosong
                                                                            </div>
                                                                        @else
                                                                            {{ $order->alasan }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade modal-md" id="cancelPesanan{{ $order->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card card-plain">
                                                        <div class="card-body pb-3">
                                                            <form role="form text-left" id="form-alasan"
                                                                method="POST"
                                                                action="cancel-pesanan/{{ $order->id }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="example-text-input"
                                                                                class="form-control-label"><span
                                                                                    class="text-xxs"
                                                                                    style="vertical-align: top;"><i
                                                                                        class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                Alasan Pemabatalan Pesanan</label>
                                                                            <input class="form-control" type="text"
                                                                                placeholder="Masukkan alasan"
                                                                                name="alasan" id="alasan"
                                                                                @error('alasan') is-invalid @enderror
                                                                                required>
                                                                            @error('alasan')
                                                                                <span class="invalid-feedback"
                                                                                    role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <button
                                                                                class="btn btn-sm ms-auto bg-gradient-danger"
                                                                                type="submit"">Batalkan
                                                                                Pesanan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                    function showcancelConfirmation() {
                                                                        Swal.fire({
                                                                            title: 'Konfirmasi',
                                                                            text: 'Apakah Anda Yakin Ingin Membatalkan Pesanan?',
                                                                            icon: 'warning',
                                                                            showCancelButton: true,
                                                                            confirmButtonText: 'Ya',
                                                                            cancelButtonText: 'Batal',
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                document.getElementById('form-alasan').submit();
                                                                            }
                                                                        });
                                                                    }
                                                                </script>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#riwayat_pes').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
            "order": [
                [3, "desc"]
            ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ Data per halaman",
                "zeroRecords": "Maaf, tidak dapat menemukan apapun",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang dapat ditampilkan",
                "infoFiltered": "(dari _MAX_ total data)",
                "search": "Cari :",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "",
                    "previous": ""
                },
            }
        });
        $('#min, #max').on('change', function() {
            var minDate = $('#min').val();
            var maxDate = $('#max').val();

            console.log(minDate, maxDate);

            table.columns(3).search('')
                .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

            $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var currentDate = new Date(data[
                        3]);
                    var selectedDate = new Date(minDate);
                    if (isNaN(selectedDate.getTime()))
                        return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                    if (minDate && !maxDate) {
                        return currentDate >= selectedDate;
                    } else if (!minDate && maxDate) {
                        return currentDate <= new Date(maxDate);
                    } else {
                        var endDate = new Date(maxDate);
                        endDate.setDate(endDate.getDate() + 1);
                        return currentDate > selectedDate && currentDate <= endDate;
                    }
                }
            );

            table.draw();
        });

        // Reset filter saat salah satu input dikosongkan
        $('#min, #max').on('keyup', function() {
            if ($('#min').val() === '' && $('#max').val() === '') {
                table.columns(5).search('').draw();
            }
        });
    });
</script>

<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="d-flex card-header pb-0 text-left">
                        <div>
                            <h3 class="font-weight-bolder text-gradient text-dark">Form Pesanan</h3>
                            <p class="mb-0">Lengkapi form dibawah untuk melakukan request pesanan!</p>
                        </div>
                        <a type="button" class="ms-auto fa-solid fa-xmark text-2xl" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="card-body pb-3">
                        <form role="form text-left" id="form-pesanan" method="POST" action="proses-pesanan">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            <span class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Pilih
                                            Menu</label>
                                        <select class="form-control form-control-sm"
                                            aria-label="Default select example" id="jenis_menu" name="jenis_menu">
                                            <option selected disabled>Pilih Menu</option>
                                            <option value="Snack">Snack</option>
                                            <option value="Menu Spesial">Menu Spesial</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label dateselect "><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Mau Dikirim Kapan?</label>
                                        <input class="form-control bg-white form-control-sm" type="datetime-local"
                                            placeholder="dd/mm/yy  -- : --" id="tanggal_pesanan"
                                            name="tanggal_pesanan" @error('tanggal_pesanan') is-invalid @enderror
                                            data-min-date=today required>
                                        @error('tanggal_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label dateselect"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Waktu Pengiriman</label>
                                        <input class="form-control bg-white form-control-sm" type="datetime-local"
                                            placeholder="dd/mm/yy  -- : --" id="waktu_pesanan" name="waktu_pesanan"
                                            @error('waktu_pesanan') is-invalid @enderror data-min-date=today required>
                                        @error('waktu_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="pilih-menu" hidden
                                        style="max-height: 350px;overflow-y: auto;">
                                        <label for="example-text-input" class="form-control-label"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Pilih Makanan</label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Lokasi
                                            Pengantaran</label>
                                        <input class="form-control form-control-sm" type="text"
                                            placeholder="Masukkan lokasi" name="lokasi" id="lokasi"
                                            @error('lokasi') is-invalid @enderror required>
                                        @error('lokasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail_karyawan" class="form-control-label"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Nama
                                            Penerima</label>
                                        <select class="form-select form-control-xs col-12" multiple
                                            name="detail_karyawan[]" id="detail_karyawan"
                                            data-placeholder="Pilih nama penerima" data-live-search="true">
                                            @foreach ($karyawan as $data)
                                                <option value="{{ $data['nik'] }} - {{ $data['nama_lengkap'] }}">
                                                    {{ $data['nik'] }} -
                                                    {{ $data['nama_lengkap'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i> Alasan
                                            Pemesanan</label>
                                        <textarea class="form-control form-control-sm" rows="4" cols="50" id="alasan_pemesanan"
                                            name="alasan_pemesanan" @error('tanggal_pesanan') is-invalid @enderror required></textarea>
                                        @error('alasan_pemesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Catatan</label>
                                        <textarea class="form-control form-control-sm" rows="4" cols="50" id="catatan" name="catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="card-header pb-0 mb-5">
                                <div class="d-flex">
                                    <button class="btn btn-sm ms-auto bg-gradient-success" type="button"
                                        onclick="showConfirmation()">Pesan</button>
                                </div>
                            </div>
                            <script>
                                // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                function showConfirmation() {
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Apakah Anda Yakin Ingin Melakukan Request Menu?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya',
                                        cancelButtonText: 'Batal',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('form-pesanan').submit();
                                        }
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#tanggal_pesanan").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        todayHighlight: false,
        mode: 'range',
        onChange: function(dates) {
            if (dates.length == 2) {
                var start = dates[0];
                var end = dates[1];

                console.log(start);
            }
        }
    });

    $("#waktu_pesanan").flatpickr({
        enableTime: true,
        dateFormat: "H:i",
        noCalendar: true
        // onChange: function(dates) {
        //     if (dates.length == 2) {
        //         var start = dates[0];
        //         var end = dates[1];

        //         console.log(start);
        //     }
        // }
    });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("#detail_karyawan").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--small",
        dropdownCssClass: "select2--small",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: true,
        tags: false,
    });
    $('#menu_tersedia').select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--medium",
        dropdownCssClass: "select2--small",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        closeOnSelect: true,
        tags: false,
    });
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Tangani perubahan pada pilihan jenis menu atau tanggal pesanan
    $(document).ready(function() {
        $('#jenis_menu, #tanggal_pesanan, #waktu_pesanan').on('change', function() {
            // Dapatkan nilai jenis menu dan tanggal pesanan yang dipilih
            var jenisMenu = $('#jenis_menu').val();
            var tanggalPesananInput = document.getElementById('tanggal_pesanan');
            var tanggalPesanan1 = tanggalPesananInput.value.split(" to ")[0];
            var tanggalPesanan2 = tanggalPesananInput.value.split(" to ")[1];
            var waktuPesanan = $('#waktu_pesanan').val();

            console.log(jenisMenu, tanggalPesanan1, tanggalPesanan2, waktuPesanan);
            if (jenisMenu != null && tanggalPesananInput.value !== null) {
                if (jenisMenu == "Others") {
                    var tanggalAw = new Date(tanggalPesanan1);
                    var tanggalAk = new Date(tanggalPesanan2);
                    $('#input-container').on('click', '.remove-input', function() {
                        $(this).closest('.tambahan-input').remove();
                    });
                    $('#pilih-menu').empty();
                    // Perbarui tampilan menu dengan data yang diterima dari server
                    $('#pilih-menu').prop('hidden', false);
                    for (var tanggal = tanggalAw; tanggal <= tanggalAk; tanggal.setDate(tanggal
                            .getDate() + 1)) {
                        var namaBulan = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        var namaHari = ['Minggu', 'Senin',
                            'Selasa', 'Rabu', 'Kamis',
                            'Jumat', 'Sabtu'
                        ];
                        var tanggalFormatBaru = namaHari[tanggal.getDay()] + ', ' + tanggal.getDate() +
                            ' ' + namaBulan[tanggal.getMonth()] + ' ' + tanggal.getFullYear();
                        $('#pilih-menu').append(
                            '<p class="fw-bold mb-0 text-sm text-dark ">' +
                            tanggalFormatBaru +
                            '</p>' +
                            '<div class="d-flex form-group col-md-12 mb-2"><div class="input-group"><input class="form-control bg-brown text-white form-control-sm" type="text" value="" name="makanan[]" placeholder = "Masukkan Nama Makanan. Contoh : Nasi Putih, Sayur, dll"><input type="number" class="form-control padding-right form-control-sm" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width:20%"></div>'
                        );
                    }
                    // $('.add-input').click(function() {
                    //     var newInput =
                    //         '<div class="d-flex form-group tambahan-input col-md-7"><div class="input-group"><input class="form-control bg-brown text-white form-control-sm" type="text" value="" name="makanan[]" placeholder = "Masukkan Nama Makanan"><input type="number" class="form-control padding-right col-md-2 form-control-sm" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width:20%"></div><a type="button" class="text-lg mt-2 remove-input fa-solid fa-circle-xmark "title="Hapus Makanan"></a><div>';
                    //     $('#input-container').append(newInput);
                    // });
                    $('#input-container').on('click', '.remove-input', function() {
                        $(this).closest('.tambahan-input').remove();
                    });
                } else {
                    $.ajax({
                        url: '/get-menu', // Ganti dengan URL endpoint yang sesuai
                        method: 'GET',
                        data: {
                            jenisMenu: jenisMenu,
                            tanggalPesanan1: tanggalPesanan1,
                            tanggalPesanan2: tanggalPesanan2,
                            waktuPesanan: waktuPesanan
                        },
                        success: function(data) {
                            $('#pilih-menu').empty();
                            // Perbarui tampilan menu dengan data yang diterima dari server
                            $('#pilih-menu').prop('hidden', false);

                            data.forEach(function(item) {
                                if (jenisMenu == "Menu Spesial") {
                                    var indekmenus = 0;
                                    item['makanan'].forEach(function(makanan) {
                                        var date = new Date(item['tglMakan']
                                            [indekmenus]);
                                        var namaHari = ['Minggu', 'Senin',
                                            'Selasa', 'Rabu', 'Kamis',
                                            'Jumat', 'Sabtu'
                                        ];
                                        var hari = namaHari[date.getDay()];
                                        var tanggal = date.getDate();
                                        var bulan = date.toLocaleString(
                                            'id-ID', {
                                                month: 'long'
                                            }
                                        );
                                        var tanggalFormatBaru = hari +
                                            ', ' + tanggal + ' ' + bulan +
                                            ' ' + date.getFullYear();
                                        $('#pilih-menu').append(
                                            '<p class="fw-bold mb-0 text-sm text-dark ">' +
                                            tanggalFormatBaru +
                                            '</p>' +
                                            '<div class="col-md-8 mb-2"><label for="example-text-input" class="form-control-label text-secondary">1,5 Main Course</label><div class="input-group"><input class="form-control bg-brown text-white form-control-sm" type="text" value="' +
                                            makanan[0] +
                                            '"name="makanan[]" readonly><input type="number" class="form-control padding-right form-control-sm" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width: 20%"></div></div>' +
                                            '<div class="col-md-8 mb-2"><label for="example-text-input" class="form-control-label text-secondary">2,5 Main Course</label><div class="input-group"><input class="form-control bg-brown text-white form-control-sm text-sm" type="text" value="' +
                                            makanan[1] +
                                            '"name="makanan[]" readonly><input type="number" class="form-control padding-right form-control-sm" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width: 20%"></div></div>'
                                        );
                                        indekmenus++;
                                    });
                                    // $('#pilih-menu').prop('hidden', true);
                                    console.log(item);
                                }
                                if (jenisMenu == "Snack") {
                                    var indeksnack = 0;
                                    item['makanan'].forEach(function(makanan) {
                                        var date = new Date(item['tglMakan']
                                            [indeksnack]);
                                        var namaHari = ['Minggu', 'Senin',
                                            'Selasa', 'Rabu', 'Kamis',
                                            'Jumat', 'Sabtu'
                                        ];
                                        var hari = namaHari[date.getDay()];
                                        var tanggal = date.getDate();
                                        var bulan = date.toLocaleString(
                                            'id-ID', {
                                                month: 'long'
                                            }
                                        );
                                        var tanggalFormatBaru = hari +
                                            ', ' + tanggal + ' ' + bulan +
                                            ' ' + date.getFullYear();
                                        $('#pilih-menu').append(
                                            '<p class="fw-bold mb-0 text-sm text-dark ">' +
                                            tanggalFormatBaru +
                                            '</p>'
                                        );
                                        makanan.forEach(function(makan) {
                                            $('#pilih-menu').append(
                                                '<div class="col-md-3 mb-2"><div class="input-group"><input class="form-control bg-brown text-white form-control-sm" type="text" value="' +
                                                makan +
                                                '"name="makanan[]" readonly><input type="number" class="form-control padding-right form-control-sm" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width: 30%"></div></div>'
                                            );
                                        });
                                        indeksnack++;
                                    });
                                    $('#pilih-menu').prop('hidden', false);
                                }

                            });
                        },
                        error: function(err) {
                            $('#pilih-menu').prop('hidden', false);
                            console.error(err);
                        }
                    });
                }
            }
        });
    });
</script>
