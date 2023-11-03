<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
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
        title: 'Oops...',
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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="riwayat_pes">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Menu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Menu</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jumlah</th>
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
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success"
                                            style="width: 90%; height: 100%;">Selesai</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                        <a href="#" class="text-secondary text-s" data-toggle="tooltip"
                                            data-original-title="Hapus">
                                            <span class="badge badge-md bg-gradient-danger"><i
                                                    class="fa-solid fa-xmark"></i></span>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-primary"
                                            style="width: 90%; height: 100%;">Diproses</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                        <a href="#" class="text-secondary text-s" data-toggle="tooltip"
                                            data-original-title="Hapus">
                                            <span class="badge badge-md bg-gradient-danger"><i
                                                    class="fa-solid fa-xmark"></i></span>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-warning"
                                            style="width: 90%; height: 100%;">Menunggu</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                        <a href="#" class="text-secondary text-s" data-toggle="tooltip"
                                            data-original-title="Hapus">
                                            <span class="badge badge-md bg-gradient-danger"><i
                                                    class="fa-solid fa-xmark"></i></span>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../images/nasigoreng.jpg" class="avatar avatar-sm me-3"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Nasi Goreng</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Menu Spesial</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">20</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Departemen</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">25/09/2023</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger"
                                            style="width: 90%; height: 100%;">Ditolak</span>
                                    </td>

                                    <td class="align-middle">
                                        @yield('btn-edit-riwayat')
                                        <a href="#" class="text-secondary text-s" data-toggle="tooltip"
                                            data-original-title="Hapus">
                                            <span class="badge badge-md bg-gradient-danger"><i
                                                    class="fa-solid fa-xmark"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-gradient text-dark">Form Pesanan</h3>
                        <p class="mb-0">Lengkapi form dibawah untuk melakukan request pesanan!</p>
                    </div>
                    <div class="card-body pb-3">
                        <form role="form text-left" id="form-pesanan" method="POST" action="/departemen/proses-pesanan">
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
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label dateselect"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Tanggal Pesanan</label>
                                        <input class="form-control" type="datetime-local"
                                            placeholder="dd/mm/yy  -- : --" id="tanggal_pesanan"
                                            name="tanggal_pesanan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-xs text-warning" id="menu_tersedia" name="menu_tersedia"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Jumlah
                                            Pesanan</label>
                                        <input class="form-control" type="number"
                                            placeholder="Masukkan jumlah pesanan" name="jumlah_pesanan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"><span
                                                class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Lokasi
                                            Pengantaran</label>
                                        <input class="form-control" type="text" placeholder="Masukkan lokasi" name="lokasi">
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
                                                <option value="{{ $data['nik'] }}">{{ $data['nik'] }} -
                                                    {{ $data['nama_lengkap'] }}</option>
                                            @endforeach
                                        </select>
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
                                <div class="d-flex align-items-center">
                                    @yield('btn-pesan')
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


<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
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
</script>

<script>
    $(document).ready(function() {
        $('#riwayat_pes').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
            "order": [
                [1, "desc"]
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
    });
</script>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Tangani perubahan pada pilihan jenis menu atau tanggal pesanan
    $(document).ready(function() {
        $('#jenis-menu, #tanggal-pesanan').on('change', function() {
            // Dapatkan nilai jenis menu dan tanggal pesanan yang dipilih
            var jenisMenu = $('#jenis-menu').val();
            var tanggalPesananInput = document.getElementById('tanggal-pesanan');
            var tanggalPesanan = tanggalPesananInput.value.split("T")[0];
            var waktuPesanan = tanggalPesananInput.value.split("T")[1];

            console.log(jenisMenu, tanggalPesanan, waktuPesanan);

            // Kirim permintaan AJAX ke server untuk mendapatkan data menu
            $.ajax({
                url: '/departemen/get-menu', // Ganti dengan URL endpoint yang sesuai
                method: 'GET',
                data: {
                    jenisMenu: jenisMenu,
                    tanggalPesanan: tanggalPesanan,
                    waktuPesanan: waktuPesanan
                },
                success: function(data) {
                    // Perbarui tampilan menu dengan data yang diterima dari server
                    $('#menu-tersedia').html(data);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });
    });
</script>
