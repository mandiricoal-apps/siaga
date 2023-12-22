@php
    use Illuminate\Support\Facades\Auth;
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
                                    <label for="example-text-input"
                                        class="form-control-label dateselect"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                        Awal</label>
                                    <input class="form-control bg-white" type="date"
                                        placeholder="yyyy-mm-dd" id="min" name="min"
                                        data-input required>
                                    @if ($errors->has('min '))
                                        <span
                                            class="text-danger text-xs">{{ $errors->first('min') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input"
                                        class="form-control-label dateselect"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                        Akhir</label>
                                    <input class="form-control bg-white" type="date"
                                        placeholder="yyyy-mm-dd" id="max" name="max"
                                        required>
                                    @if ($errors->has('max'))
                                        <span
                                            class="text-danger text-xs">{{ $errors->first('max') }}</span>
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
                                            <span class="text-secondary text-xs font-weight-bold">{{$order->created_at}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$order->tanggal_pesanan}}</span>
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
                                            @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak')
                                                <span class="badge badge-sm bg-gradient-danger"
                                                    style="width: 90%; height: 100%;">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a type="button" class="fa-solid fa-eye text-s badge badge-md text-dark"
                                                data-toggle="tooltip" data-original-title="Detail"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailPesanan{{ $order->order_id }}"
                                                style="border: solid 1px">
                                            </a>
                                            @if ($order->status == 'Dibatalkan' || $order->status == 'Selesai')
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
                                                <a type="button" class="btn badge badge-md text-dark fa-solid fa-xmark"
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
                                                                    @if ($order->status == 'Menunggu' || $order->status == 'Diproses')
                                                                        <span
                                                                            class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                                                    @endif
                                                                    @if ($order->status == 'Dibatalkan' || $order->status == 'Ditolak')
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
                                                                $tgl = \Carbon\Carbon::parse($order->tanggal_pesanan);
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
                                                                    {{ $tgl->format('d F Y') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Jam
                                                                    Pengiriman
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $tgl->format('h:i A') }}
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
                                                        </div>
                                                        <div class="col-md-6" style="margin-left: 5%">
                                                            <div class="justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Menu Makanan
                                                                </p>
                                                                @if ($order->jenis_pesanan == 'Menu Spesial')
                                                                    @if ($detail_porsi[0] != 0)
                                                                        <p class="fw-bold mb-0 text-md text-dark">
                                                                            {{ $num++ }}. Menu Spesial 1,5 main
                                                                            course
                                                                        </p>
                                                                        <p class="mb-0 text-md text-dark"
                                                                            style="margin-left: 4%">
                                                                            {{ $detail_menu[0] }} :
                                                                            {{ $detail_porsi[0] }} porsi
                                                                        </p>
                                                                    @endif
                                                                    @if ($detail_porsi[1] != 0)
                                                                        <p class="fw-bold mb-0 text-md text-dark">
                                                                            {{ $num++ }}. Menu Spesial 2,5 main
                                                                            course
                                                                        </p>
                                                                        <p class="mb-0 text-md text-dark"
                                                                            style="margin-left: 4%">
                                                                            {{ $detail_menu[1] }} :
                                                                            {{ $detail_porsi[1] }} porsi
                                                                        </p>
                                                                    @endif
                                                                @else
                                                                    @for ($i = 0; $i < count($detail_menu) && $i < count($detail_porsi); $i++)
                                                                        @if ($detail_porsi[$i] != 0)
                                                                            <span class="text-muted">
                                                                                {{ $detail_menu[$i] }} :
                                                                                <b
                                                                                    class="text-dark">{{ $detail_porsi[$i] }}</b>
                                                                                porsi
                                                                            </span>

                                                                            @if (count($detail_menu) == 1)
                                                                            @else
                                                                                @if ($i < count($detail_menu) - 1)
                                                                                    <br>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endfor
                                                                @endif
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
                                        <select class="form-control" aria-label="Default select example"
                                            id="jenis_menu" name="jenis_menu">
                                            <option selected disabled>Pilih Menu</option>
                                            <option value="Snack">Snack</option>
                                            <option value="Menu Spesial">Menu Spesial</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label dateselect"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Mau Dikirim Kapan?</label>
                                        <input class="form-control bg-white" type="datetime-local"
                                            placeholder="dd/mm/yy  -- : --" id="tanggal_pesanan"
                                            name="tanggal_pesanan" @error('tanggal_pesanan') is-invalid @enderror data-min-date=today
                                            required>
                                        @error('tanggal_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="pilih-menu" hidden>
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
                                        <input class="form-control" type="text" placeholder="Masukkan lokasi"
                                            name="lokasi" id="lokasi" @error('lokasi') is-invalid @enderror
                                            required>
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
                                        <select class="form-select form-control-sm col-12" multiple
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
                                        <textarea class="form-control" rows="4" cols="50" id="alasan_pemesanan" name="alasan_pemesanan"
                                            @error('tanggal_pesanan') is-invalid @enderror required></textarea>
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
                                        <textarea class="form-control" rows="4" cols="50" id="catatan" name="catatan"></textarea>
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
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss",
        onChange: function(dates) {
            if (dates.length == 2) {
                var start = dates[0];
                var end = dates[1];

                console.log(start);
            }
        }
    });
</script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("#detail_karyawan").select2({
        theme: "bootstrap-5",
        selectionCssClass: "select2--medium",
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Tangani perubahan pada pilihan jenis menu atau tanggal pesanan
    $(document).ready(function() {
        $('#jenis_menu, #tanggal_pesanan, #waktu_pesanan').on('change', function() {
            // Dapatkan nilai jenis menu dan tanggal pesanan yang dipilih
            var jenisMenu = $('#jenis_menu').val();
            var tanggalPesananInput = document.getElementById('tanggal_pesanan');
            var tanggalPesanan = tanggalPesananInput.value.split(" ")[0];
            var waktuPesanan = $('#waktu_pesanan').value();

            console.log(jenisMenu,tanggalPesanan, waktuPesanan);
            if (jenisMenu != null && tanggalPesananInput.value !== null) {
                if (jenisMenu == "Others") {
                    $('#input-container').on('click', '.remove-input', function() {
                        $(this).closest('.tambahan-input').remove();
                    });
                    $('#pilih-menu').empty();
                    // Perbarui tampilan menu dengan data yang diterima dari server
                    $('#pilih-menu').prop('hidden', false);
                    $('#pilih-menu').append(
                        '<div class="d-flex form-group col-md-7 mb-2"><div class="input-group"><input class="form-control bg-brown text-white" type="text" value="" name="makanan[]" placeholder = "Masukkan Nama Makanan"><input type="number" class="form-control padding-right" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width:20%"></div><a type="button" class="text-lg mt-2 add-input fa-solid fa-circle-plus "title="Tambah Makanan"></a></div><div class="col-md-12" id="input-container"></div>'
                    );
                    $('.add-input').click(function() {
                        var newInput =
                            '<div class="d-flex form-group tambahan-input col-md-7"><div class="input-group"><input class="form-control bg-brown text-white" type="text" value="" name="makanan[]" placeholder = "Masukkan Nama Makanan"><input type="number" class="form-control padding-right col-md-2" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width:20%"></div><a type="button" class="text-lg mt-2 remove-input fa-solid fa-circle-xmark "title="Hapus Makanan"></a><div>';
                        $('#input-container').append(newInput);
                    });
                    $('#input-container').on('click', '.remove-input', function() {
                        $(this).closest('.tambahan-input').remove();
                    });
                } else {
                    $.ajax({
                        url: '/get-menu', // Ganti dengan URL endpoint yang sesuai
                        method: 'GET',
                        data: {
                            jenisMenu: jenisMenu,
                            tanggalPesanan: tanggalPesanan,
                            waktuPesanan: waktuPesanan
                        },
                        success: function(data) {
                            $('#pilih-menu').empty();
                            // Perbarui tampilan menu dengan data yang diterima dari server
                            $('#pilih-menu').prop('hidden', false);
                            data.forEach(function(item) {

                                if (jenisMenu == "Menu Spesial") {
                                    $('#pilih-menu').append(
                                        '<div class="col-md-6 mb-2"><div class="input-group"><input class="form-control bg-brown text-white" type="text" value="' +
                                        item +
                                        '"name="makanan[]" readonly><input type="number" class="form-control padding-right" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width: 20%"></div></div>'
                                    );
                                }
                                if (jenisMenu == "Snack") {

                                    $('#pilih-menu').append(
                                        '<div class="col-md-3 mb-2"><div class="input-group"><input class="form-control bg-brown text-white" type="text" value="' +
                                        item +
                                        '"name="makanan[]" readonly><input type="number" class="form-control padding-right" name="jumlah_pesanan[]" value=0 min="0" style="text-align: center;max-width: 30%"></div></div>'
                                    );
                                }
                            });
                        },
                        error: function(err) {
                            // $('#menu_tersedia').empty();
                            $('#pilih-menu').prop('hidden', true);
                            console.error(err);
                        }
                    });
                }
            }
        });
    });
</script>
