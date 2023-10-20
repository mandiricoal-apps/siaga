<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
    /* CSS untuk menyembunyikan formulir */
    #form-tambah {
        display: none;
    }
</style>
<!-- End Navbar -->
<div class="container-fluid py-4 mt-3">
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
    <div class="row justify-content-center">

        <div class="col-12 mb-4">
            <div class="card-header pb-0">
                <div class=" align-items-center">
                    <button class="btn btn-sm ms-auto bg-gradient-success" onclick="toggleForm()">Tambah Data Menu
                        Mingguan</button>
                </div>
            </div>
            <form action="{{ route('catering.addmenu') }}" method="POST" id="form-menu">
                @csrf
                <div class="card" id="form-tambah">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 fw-bold fs-4"> Form Tambah Menu</p>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Nama Menu
                                        Makan</label>
                                    <input class="form-control" name="nama_makanan" type="text" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Jenis Menu</label>
                                    <select name="jenis_makanan" class="form-select" required>
                                        <option value="0">Pilih Jenis Menu</option>
                                        <option value="1">Menu Spesial</option>
                                        <option value="2">Snack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Deskripsi</label>
                                    <textarea class="form-control" rows="4" cols="50" name="deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm"><span class="text-xxs" style="vertical-align: top;"><i
                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Masa Berlaku
                        </p>
                        <div class="row">
                            <div class="form-group col-md-3">

                                <label for="detail_karyawan" class="form-control-label">Senin</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Selasa</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Rabu</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Kamis</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Jumat</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Sabtu</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
                                    <select name="shift[]" class="form-select" required>
                                        <option value="0" selected>Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="detail_karyawan" class="form-control-label">Minggu</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal[]" class="form-control" value=""
                                        required readonly>
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
                                <button class="btn btn-sm ms-auto bg-gradient-success" type="button" onclick="showConfirmation()">Tambah</button>
                            </div>
                        </div>
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
        <div class="col-12 text mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4">Jadwal Snack Mingguan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 rotated-table" style="min-height: 300px">
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
                                            <p class="text-xs">{{ $date->isoFormat('DD MMM YYYY') }}</p>
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
                                                <td class="align-middle text-center text-sm">
                                                    @foreach ($snacksInShift as $snack)
                                                        @php
                                                            $carbonDate = \Carbon\Carbon::parse($snack->tanggal_berlaku);
                                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                        @endphp
                                                        @if ($dayOfWeek == array_search($day, [-1, 0, 1, 2, 3, 4, 5]) && $snack->shift == $shift)
                                                            <span
                                                                class="text-secondary text-xs font-weight-bold">{{ $snack->nama_makanan }}</span>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <th colspan="8" class="align-middle text-center">
                                            <span class="text-secondary text-md font-weight-bold"><em>Data Snack
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
        <div class="col-12 text mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4">Jadwal Menu Spesial Mingguan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 rotated-table" style="min-height: 300px">
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
                                            <p class="text-xs">{{ $date->isoFormat('DD MMM YYYY') }}</p>
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
                                                <td class="align-middle text-center text-md">
                                                    @foreach ($menusInShift as $menu)
                                                        @php
                                                            $carbonDate = \Carbon\Carbon::parse($menu->tanggal_berlaku);
                                                            $dayOfWeek = $carbonDate->dayOfWeek; // Mendapatkan indeks hari (0 untuk Minggu, 1 untuk Senin, dst.)
                                                        @endphp
                                                        @if ($dayOfWeek == array_search($day, [-1, 0, 1, 2, 3, 4, 5]) && $menu->shift == $shift)
                                                            <span
                                                                class="text-secondary text-sm font-weight-bold">{{ $menu->nama_makanan }}</span>
                                                            <br>
                                                            @php
                                                                $menuFound = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <th colspan="8" class="align-middle text-center">
                                            <span class="text-secondary text-md font-weight-bold"><em>Data Menu Spesial
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

<script>
    // Fungsi untuk menampilkan atau menyembunyikan formulir
    function toggleForm() {
        var form = document.getElementById('form-tambah');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
