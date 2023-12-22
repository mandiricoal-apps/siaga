<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    /* CSS untuk menyembunyikan formulir */
    #form-tambah {
        display: block;
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
<div class="container-fluid py-4 mt-3">
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
    <div class="row justify-content-center">
        <div class="col-12 mb-2">
            <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#add-menu" role="tab"
                            aria-controls="add-menu" aria-selected="true">
                            Tambah Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#jadwal-snacks" role="tab"
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
                    <div class="tab-pane fade show active" id="add-menu" role="tabpanel"aria-labelledby="add-menu">
                        <div class="col-12 mt-4">
                            <form action="{{ route('catering.addmenu') }}" method="POST" id="form-menu">
                                @csrf
                                <div class="card" id="form-tambah">
                                    <div class="card-header pb-0">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 fw-bold fs-4"> Form Tambah Menu</p>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label"><span
                                                        class="text-xxs" style="vertical-align: top;"><i
                                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                    Jenis Menu</label>
                                                <select name="jenis_makanan" class="form-select" required>
                                                    <option value="0">Pilih Jenis Menu</option>
                                                    <option value="1">Menu Spesial</option>
                                                    <option value="2">Snack</option>
                                                    <option value="3">Reguler</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 dataMakanan" hidden>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label"><span
                                                            class="text-xxs" style="vertical-align: top;"><i
                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                        Nama Makanan atau Minuman</label>
                                                    <div class="row namaMakanan">
                                                        <div class="input-group">
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="nama_makanan[]"
                                                                    type="text" value="">
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button"
                                                                    class="btn btn-success text-lg add-input fa-solid fa-circle-plus "
                                                                    title="Tambah Makanan"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="input-container">

                                            </div>
                                            {{-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Deskripsi</label>
                                                    <textarea class="form-control" rows="4" cols="50" name="deskripsi"></textarea>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <hr class="horizontal dark">
                                        <p class="text-uppercase text-sm"><span class="text-xxs"
                                                style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Masa Berlaku
                                        </p>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal1"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal2"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal3"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal4"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal5"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal6"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <input type="date" name="tanggal[]" id="tanggal7"
                                                        class="form-control bg-white" value="" required>
                                                    <select name="shift[]" class="form-select" required>
                                                        <option value="0" selected>Pilih Shift</option>
                                                        <option value="Pagi">Pagi</option>
                                                        <option value="Siang">Siang</option>
                                                        <option value="Malam">Malam</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="horizontal dark">
                                        <div class="card-header pb-0 mb-5">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-sm ms-auto bg-gradient-success" type="button"
                                                    onclick="showConfirmation()">Tambah</button>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#tanggal1,#tanggal2,#tanggal3,#tanggal4,#tanggal5,#tanggal6,#tanggal7").flatpickr({
                                                    dateFormat: "Y-m-d"
                                                });

                                                $('select[name="jenis_makanan"]').on('change', function() {
                                                    // Mendapatkan nilai opsi yang dipilih
                                                    const menu = $(this).val();
                                                    console.log(menu); // Melakukan log nilai opsi yang dipilih ke konsol

                                                    if (menu == 1) {
                                                        $('.dataMakanan').prop('hidden', false);
                                                        $('.namaMakanan').empty();
                                                        $('#input-container').empty();
                                                        $('.namaMakanan').append(
                                                            '<div class="input-group mb-3"><div class="col-md-1"><input class="form-control bg-brown text-white text-center" value="1,5" type="text"value="" readonly></div><div class="col-md-5"><input class="form-control" name="nama_makanan[]" type="text"value=""></div></div></div><div class="input-group mb-3"><div class="col-md-1"><input class="form-control bg-brown text-white text-center" value="2,5" type="text"value="" readonly></div><div class="col-md-5"><input class="form-control" name="nama_makanan[]" type="text"value=""></div></div></div>'
                                                        );
                                                    } else if (menu == 0) {
                                                        $('.dataMakanan').prop('hidden', true);
                                                        $('.namaMakanan').empty();
                                                    } else {
                                                        $('.dataMakanan').prop('hidden', false);
                                                        $('.namaMakanan').empty();
                                                        $('.namaMakanan').append(
                                                            '<div class="input-group"><div class="col-6"><input class="form-control" name="nama_makanan[]" type="text" value=""></div><div class="col-1"><button type="button" class="btn btn-success text-lg add-input fa-solid fa-circle-plus " title="Tambah Makanan"></button></div></div>'
                                                        );
                                                        $('.add-input').click(function() {
                                                            var newInput =
                                                                '<div class="form-group tambahan-input"><div class="row"><div class="input-group"><div class="col-md-6"><input type="text" name="nama_makanan[]" class="form-control" placeholder="" /></div><div class="col-md-1"><button type="button" class="btn btn-danger text-lg fa-solid fa-circle-xmark remove-input" title="Hapus Field"></button></div></div></div></div>';
                                                            $('#input-container').append(newInput);
                                                        });
                                                    }
                                                });

                                                $('.add-input').click(function() {
                                                    var newInput =
                                                        '<div class="form-group tambahan-input"><div class="row"><div class="input-group"><div class="col-md-6"><input type="text" name="nama_makanan[]" class="form-control" placeholder="" /></div><div class="col-md-1"><button type="button" class="btn btn-danger text-lg fa-solid fa-circle-xmark remove-input" title="Hapus Field"></button></div></div></div></div>';
                                                    $('#input-container').append(newInput);
                                                });
                                                $('#input-container').on('click', '.remove-input', function() {
                                                    $(this).closest('.tambahan-input').remove();
                                                });

                                            });
                                        </script>
                                        <script>
                                            // Fungsi untuk mendapatkan tanggal berdasarkan label hari
                                            function getStartDateByDay(dayLabel) {
                                                const today = new Date();
                                                const currentDayOfWeek = today.getDay(); // 0 untuk Minggu, 1 untuk Senin, dst.
                                                const sunday = new Date(today);
                                                sunday.setDate(today.getDate() - currentDayOfWeek); // Set to the most recent Sunday
                                                const dayIndex = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"].indexOf(dayLabel);
                                                return new Date(sunday.setDate(sunday.getDate() + dayIndex + 1)).toISOString().split('T')[
                                                    0]; // Format tanggal (YYYY-MM-DD)
                                            }

                                            // Fungsi untuk mengatur tanggal input berdasarkan label hari
                                            function setStartDateByDay(dayLabel, inputElement) {
                                                const startDate = getStartDateByDay(dayLabel);
                                                inputElement.value = startDate;
                                            }

                                            // Panggil fungsi setStartDateByDay saat halaman dimuat untuk mengatur tanggal input
                                            window.onload = function() {
                                                const dayLabels = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
                                                const dateInputs = document.querySelectorAll('input[name="tanggal[]"]');
                                                dayLabels.forEach((dayLabel, index) => {
                                                    setStartDateByDay(dayLabel, dateInputs[index]);
                                                });
                                            };
                                        </script>

                                        <script>
                                            // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                            function showConfirmation() {
                                                Swal.fire({
                                                    title: 'Konfirmasi',
                                                    text: 'Apakah Anda yakin ingin menambahkan data ini?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Ya',
                                                    cancelButtonText: 'Batal',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('form-menu').submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="jadwal-snacks" role="tabpanel"aria-labelledby="snacks">
                        <div class="col-12 text mt-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fw-bold fs-4">Jadwal Snack Mingguan</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0 rotated-table"
                                            style="min-height: 300px">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    @foreach (range(0, 6) as $i)
                                                        @php
                                                            $date = now()
                                                                ->startOfWeek()
                                                                ->addDays($i);
                                                        @endphp
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                            {{ $date->isoFormat('dddd') }}<br>
                                                            <p class="text-xs">{{ $date->isoFormat('DD MMM YYYY') }}
                                                            </p>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            @if ($countSnack != 0)
                                                <tbody>
                                                    @foreach ($groupedSnacks as $shift => $snacksInShift)
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="text-secondary text-md font-weight-bold">{{ $shift }}</span>
                                                            </td>
                                                            @foreach (range(0, 6) as $day)
                                                                @php
                                                                    $date = now()
                                                                        ->startOfWeek()
                                                                        ->addDays($day);
                                                                @endphp
                                                                <td
                                                                    class="align-middle text-center text-sm timeline-item">
                                                                    @php
                                                                        $makananShiftTersedia = false;
                                                                    @endphp
                                                                    @foreach ($snacksInShift as $snack)
                                                                        @php
                                                                            $carbonDate = \Carbon\Carbon::parse($snack->tanggal_berlaku);
                                                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                                            $namaMakanan = json_decode($snack->nama_makanan, true);
                                                                        @endphp
                                                                        @if ($dayOfWeek == array_search($day, [-1, 0, 1, 2, 3, 4, 5]) && $snack->shift == $shift)
                                                                            <a type="button" class=""
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal{{ $snack->id }}">
                                                                                <span
                                                                                    class="text-dark text-xs fw-bold">
                                                                                    Menu Tersedia
                                                                                </span>
                                                                            </a>
                                                                            @php
                                                                                $makananShiftTersedia = true;
                                                                            @endphp
                                                                            <br>
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
                                                                                                id="exampleModalLabel">
                                                                                                Detail
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
                                                                                                    {{ $formattedDate }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="d-flex justify-content-between mb-3">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg  text-dark">
                                                                                                    Shift</p>
                                                                                                <p
                                                                                                    class="text-muted mb-0 text-md">
                                                                                                    {{ $snack->shift }}
                                                                                                </p>
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
                                                                                                        07.00 - 12.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($snack->shift == 'Siang')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        12.00 - 17.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($snack->shift == 'Malam')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        17.00 - 20.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                            </div>
                                                                                            @php
                                                                                                $makanan = json_decode($snack->nama_makanan, true);
                                                                                                $no = 1;
                                                                                            @endphp
                                                                                            <div class="justify-content-between mb-3"
                                                                                                style="text-align: left">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                                    Snack Tersedia
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
                                                                        <span class="text-danger text-xs fw-bold"
                                                                            style="font-style: italic">
                                                                            Menu Belum Tersedia
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <th colspan="8" class="align-middle text-center">
                                                            <span class="text-secondary text-md font-weight-bold"><em>Data
                                                                    Snack
                                                                    Masih Kosong</em></span>
                                                        </th>

                                                    </tr>
                                                </tbody>
                                            @endif

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="jadwal-menus" role="tabpanel"aria-labelledby="menus">
                        <div class="col-12 text mt-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fw-bold fs-4">Jadwal Menu Spesial Mingguan</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0 rotated-table"
                                            style="min-height: 300px">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    @foreach (range(0, 6) as $i)
                                                        @php
                                                            $date = now()
                                                                ->startOfWeek()
                                                                ->addDays($i);
                                                        @endphp
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                            {{ $date->isoFormat('dddd') }}<br>
                                                            <p class="text-xs">{{ $date->isoFormat('DD MMM YYYY') }}
                                                            </p>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            @if ($countMenus != 0)
                                                <tbody class=>
                                                    @foreach ($groupedMenus as $shift => $menusInShift)
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="text-secondary text-md font-weight-bold">{{ $shift }}</span>
                                                            </td>
                                                            @foreach (range(0, 6) as $day)
                                                                @php
                                                                    $date = now()
                                                                        ->startOfWeek()
                                                                        ->addDays($day);
                                                                @endphp
                                                                <td
                                                                    class="align-middle text-center text-md timeline-item">
                                                                    @php
                                                                        $makananShiftTersedia = false; // Inisialisasi variabel
                                                                    @endphp
                                                                    @foreach ($menusInShift as $menu)
                                                                        @php
                                                                            $carbonDate = \Carbon\Carbon::parse($menu->tanggal_berlaku);
                                                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)

                                                                            $namaMakanan = json_decode($menu->nama_makanan, true);
                                                                        @endphp
                                                                        @if ($dayOfWeek == array_search($day, [-1, 0, 1, 2, 3, 4, 5]) && $menu->shift == $shift)
                                                                            <a type="button" class=""
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#menusModal{{ $menu->id }}">
                                                                                <span
                                                                                    class="text-dark fw-bold text-xs">
                                                                                    Menu Tersedia
                                                                                </span>
                                                                            </a>
                                                                            <br>
                                                                            @php
                                                                                $makananShiftTersedia = true; // Inisialisasi variabel
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
                                                                                                id="exampleModalLabel">
                                                                                                Detail
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
                                                                                                    {{ $formattedDate }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="d-flex justify-content-between mb-3">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg  text-dark">
                                                                                                    Shift</p>
                                                                                                <p
                                                                                                    class="text-muted mb-0 text-md">
                                                                                                    {{ $menu->shift }}
                                                                                                </p>
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
                                                                                                        07.00 - 12.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($menu->shift == 'Siang')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        12.00 - 17.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($menu->shift == 'Malam')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        17.00 - 20.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                            </div>
                                                                                            @php
                                                                                                $makanan = json_decode($menu->nama_makanan, true);
                                                                                                $no = 1;
                                                                                            @endphp
                                                                                            <div class="justify-content-between mb-3"
                                                                                                style="text-align: left">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                                    Menu Tersedia
                                                                                                </p>
                                                                                                <p
                                                                                                    class="text-muted mb-0 text-md fw-bold">
                                                                                                    {{ $no }}.
                                                                                                    Menu
                                                                                                    Spesial 1,5 main
                                                                                                    course
                                                                                                </p>
                                                                                                <p class="text-muted mb-0 text-md"
                                                                                                    style="margin-left: 5%">
                                                                                                    {{ $makanan[0] }}
                                                                                                </p>
                                                                                                <p
                                                                                                    class="text-muted mb-0 text-md fw-bold">
                                                                                                    {{ $no + 1 }}.
                                                                                                    Menu
                                                                                                    Spesial 2,5 main
                                                                                                    course
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
                                                                        <span class="text-danger text-xs fw-bold"
                                                                            style="font-style: italic">
                                                                            Menu Belum Tersedia
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <th colspan="8" class="align-middle text-center">
                                                            <span class="text-secondary text-md font-weight-bold"><em>Data
                                                                    Menu Spesial
                                                                    Masih Kosong</em></span>
                                                        </th>

                                                    </tr>
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show " id="jadwal-menur" role="tabpanel"aria-labelledby="menur">
                        <div class="col-12 text mt-4">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fw-bold fs-4">Jadwal Menu Reguler Mingguan</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0 rotated-table"
                                            style="min-height: 300px">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    @foreach (range(0, 6) as $i)
                                                        @php
                                                            $date = now()
                                                                ->startOfWeek()
                                                                ->addDays($i);
                                                        @endphp
                                                        <th
                                                            class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                            {{ $date->isoFormat('dddd') }}<br>
                                                            <p class="text-xs">{{ $date->isoFormat('DD MMM YYYY') }}
                                                            </p>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            @if ($countRegulers != 0)
                                                <tbody>
                                                    @foreach ($groupedRegulers as $shift => $regulersInShift)
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="text-secondary text-md font-weight-bold">{{ $shift }}</span>
                                                            </td>
                                                            @foreach (range(0, 6) as $day)
                                                                @php
                                                                    $date = now()
                                                                        ->startOfWeek()
                                                                        ->addDays($day);
                                                                @endphp
                                                                <td
                                                                    class="align-middle text-center text-sm timeline-item">
                                                                    @php
                                                                        $makananShiftTersedia = false; // Inisialisasi variabel
                                                                    @endphp
                                                                    @foreach ($regulersInShift as $reguler)
                                                                        @php
                                                                            $carbonDate = \Carbon\Carbon::parse($reguler->tanggal_berlaku);
                                                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                                            $namaMakanan = json_decode($reguler->nama_makanan, true);
                                                                        @endphp
                                                                        @if ($dayOfWeek == array_search($day, [-1, 0, 1, 2, 3, 4, 5]) && $reguler->shift == $shift)
                                                                            <a type="button" class=""
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#menur{{ $reguler->id }}">
                                                                                <span
                                                                                    class="text-dark fw-bold text-xs">
                                                                                    Menu Tersedia
                                                                                </span>
                                                                                @php
                                                                                    $makananShiftTersedia = true;
                                                                                @endphp
                                                                            </a>
                                                                            <br>
                                                                            <div class="modal fade"
                                                                                id="menur{{ $reguler->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered"
                                                                                    role="document">
                                                                                    <div class="modal-content m-5">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Detail
                                                                                                Menu</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            @php
                                                                                                $makanan = json_decode($reguler->nama_makanan, true);
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
                                                                                                        $tgl = $reguler->tanggal_berlaku;
                                                                                                        $timestamp = strtotime($tgl);
                                                                                                        $formattedDate = date('d F Y', $timestamp);
                                                                                                    @endphp
                                                                                                    {{ $formattedDate }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="d-flex justify-content-between mb-3">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg  text-dark">
                                                                                                    Shift</p>
                                                                                                <p
                                                                                                    class="text-muted mb-0 text-md">
                                                                                                    {{ $reguler->shift }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="d-flex justify-content-between mb-3">
                                                                                                <p
                                                                                                    class="fw-bold mb-0 text-lg text-dark">
                                                                                                    Waktu Pesanan
                                                                                                </p>
                                                                                                @if ($reguler->shift == 'Pagi')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        07.00 - 12.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($reguler->shift == 'Siang')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        12.00 - 17.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                                @if ($reguler->shift == 'Malam')
                                                                                                    <p
                                                                                                        class="text-muted mb-0 text-md">
                                                                                                        17.00 - 20.00
                                                                                                        WIB </p>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="justify-content-between mb-3"
                                                                                                style="text-align: left">
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
                                                                        <span class="text-danger text-xs fw-bold"
                                                                            style="font-style: italic">
                                                                            Menu Belum Tersedia
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <th colspan="8" class="align-middle text-center">
                                                            <span class="text-secondary text-md font-weight-bold"><em>Data
                                                                    Menu Reguler
                                                                    Masih Kosong</em></span>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            @endif

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
