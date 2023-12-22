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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- css untuk select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css"
    integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0 text-left">
                    <h3 class="font-weight-bolder text-gradient text-dark">Form Pesanan</h3>
                    <p class="mb-0">Ubah form dibawah untuk mengubah request pesanan!</p>
                </div>
                <div class="card-body pb-3">
                    <form role="form text-left" id="form-pesanan" method="POST"
                        action="/update-pesanan/{{ $orders->id }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">
                                        <span class="text-xxs" style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Pilih
                                        Menu</label>
                                    <select class="form-control" aria-label="Default select example" id="jenis_menu"
                                        name="jenis_menu" disabled>
                                        <option value="0" selected disabled>{{ $orders->jenis_pesanan }}</option>
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
                                        Mau Dikirim Kapan?</label>
                                    <input class="form-control" type="datetime-local" placeholder="dd/mm/yy  -- : --"
                                        id="tanggal_pesanan" name="tanggal_pesanan"
                                        @error('tanggal_pesanan') is-invalid @enderror value="24/12/2023   30/12/2023"
                                        required disabled>
                                    @error('tanggal_pesanan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                @php
                                    $waktuPes = \Carbon\Carbon::createFromDate($orders->waktu_pesanan)->format('H:i');
                                    $wPes = explode(':', $waktuPes);
                                @endphp
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label dateselect"><span
                                            class="text-xxs" style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Waktu Pengiriman</label>
                                    <input class="form-control form-control-sm" type="time" placeholder="-- : --"
                                        id="waktu_pesanan" name="waktu_pesanan" value="{{ $waktuPes }}"
                                        @error('waktu_pesanan') is-invalid @enderror data-min-date=today required
                                        disabled>
                                    @error('waktu_pesanan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @php
                                $detail_menu = json_decode($orders->makanan, true);
                                $detail_porsi = json_decode($orders->jumlah_pesanan, true);
                            @endphp
                            <div class="col-md-12">
                                <div class="row" id="pilih-menu">
                                    @php
                                        $tanggalPesan = json_decode($orders->tanggal_pesanan, true);

                                    @endphp
                                    @if ($orders->jenis_pesanan != 'Menu Spesial')
                                        @if ($orders->jenis_pesanan == 'Snack')
                                            @php
                                                $menu = json_decode($orders->id_menu, true);
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
                                                    $porsi = json_decode($orders->jumlah_pesanan, true);
                                                    $tglMenu = \Carbon\Carbon::parse($namaMenu->tanggal_berlaku);
                                                @endphp
                                                <b class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                                <br>
                                                @foreach ($nmakanan as $nm)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="input-group"><input
                                                                class="form-control bg-brown text-white" type="text"
                                                                value="{{ $nm }}"name="makanan[]"
                                                                readonly><input type="number"
                                                                class="form-control padding-right"
                                                                name="jumlah_pesanan[]" value={{ $porsi[$i] }}
                                                                min="0"
                                                                style="text-align: center; max-width: 25%"></div>
                                                    </div>
                                                    @php
                                                        $k++;
                                                        $i++;
                                                        $indeksMenu++;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                        @endif
                                        @if ($orders->jenis_pesanan == 'Others')
                                            @php
                                                $kirim = json_decode($orders->tanggal_pesanan, true);
                                                $tanggalAwal = new DateTime($kirim[0]);
                                                $tanggalAkhir = new DateTime($kirim[1]);

                                                $tanggalAkhir->modify('+1 day');

                                                $interval = new DateInterval('P1D'); // Interval 1 hari
                                                $daterange = new DatePeriod($tanggalAwal, $interval, $tanggalAkhir);
                                                $k = 0;
                                                $i = 0;
                                                $namaMakanan = json_decode($orders->makanan, true);
                                                $porsi = json_decode($orders->jumlah_pesanan, true);
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
                                                <div class="col-md-4 mb-2">
                                                    <div class="input-group"><input
                                                            class="form-control bg-brown text-white" type="text"
                                                            value="{{ $namaMakanan[$i] }}"name="makanan[]"><input
                                                            type="number" class="form-control padding-right"
                                                            name="jumlah_pesanan[]" value={{ $porsi[$k] }}
                                                            min="0" style="text-align: center; max-width: 25%">
                                                    </div>
                                                </div>
                                                @php
                                                    $k++;
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        @endif
                                    @else
                                        @php
                                            $menu = json_decode($orders->id_menu, true);
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
                                                // dd($detail_porsi);
                                            @endphp
                                            <b class="text-dark">{{ $tglMenu->isoFormat('dddd, DD MMMM YYYY') }}</b>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="input-group">
                                                        <input class="form-control bg-brown text-white" type="text"
                                                            value="{{ $nmakanan[0] }}"name="makanan[]" readonly>
                                                        <input type="number" class="form-control padding-right"
                                                            name="jumlah_pesanan[]" value={{ $detail_porsi[$k] }}
                                                            min="0" style="text-align: center; max-width: 18%">
                                                    </div>
                                                </div>
                                                @php
                                                    $k++;
                                                    $i++;
                                                @endphp
                                                <div class="col-md-6 mb-2">
                                                    <div class="input-group">
                                                        <input class="form-control bg-brown text-white" type="text"
                                                            value="{{ $nmakanan[1] }}"name="makanan[]" readonly>
                                                        <input type="number" class="form-control padding-right"
                                                            name="jumlah_pesanan[]" value={{ $detail_porsi[$k] }}
                                                            min="0" style="text-align: center; max-width: 18%">
                                                    </div>
                                                </div>
                                                @php
                                                    $k++;
                                                    $i++;
                                                @endphp
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Lokasi
                                        Pengantaran</label>
                                    <input class="form-control" type="text" placeholder="Masukkan lokasi"
                                        name="lokasi" id="lokasi" value="{{ $orders->lokasi_pengantaran }}"
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
                                    <label for="detail_karyawan" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Nama
                                        Penerima</label>
                                    <select class="form-select form-control-sm col-12" multiple
                                        name="detail_karyawan[]" id="detail_karyawan"
                                        data-placeholder="Pilih nama penerima" data-live-search="true">
                                        @php
                                            $delimiter = ','; // Delimiter yang ingin Anda gunakan, misalnya koma (',')
                                            $string = $orders->detail_karyawan; // String yang akan dipecah
                                            $array = explode($delimiter, $string);
                                        @endphp
                                        @foreach ($array as $detail)
                                            <option value="{{ $detail }}" selected>{{ $detail }}</option>
                                        @endforeach
                                        @foreach ($karyawan as $data)
                                            <option value="{{ $data['nik'] }}">{{ $data['nik'] }} -
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
                                        @error('tanggal_pesanan') is-invalid @enderror required>{{ $orders->alasan_pemesanan }}</textarea>
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
                                    <textarea class="form-control" rows="4" cols="50" id="catatan" name="catatan">{{ $orders->catatan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="card-header pb-0 mb-5">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm ms-auto bg-gradient-warning"
                                    onclick="showConfirmation()">Ubah</button>
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

<script>
    // $("#waktu_pesanan").flatpickr({
    //     enableTime: true,
    //     dateFormat: "H:i",
    //     noCalendar: true,
    //     defaultDate: "08:00"
    // });

    $("#tanggal_pesanan").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        todayHighlight: false,
        mode: 'range',
        defaultDate: ["{{ $tanggalPesan[0] }}", "{{ $tanggalPesan[1] }}"],
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

    $("#detail_karyawan2").select2({
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> --}}
<script>
    // Tangani perubahan pada pilihan jenis menu atau tanggal pesanan
    $(document).ready(function() {
        $('#jenis_menu, #tanggal_pesanan, #waktu_pesanan').on('change', function() {
            // Dapatkan nilai jenis menu dan tanggal pesanan yang dipilih
            var jenisMenu = "{{ $orders->jenis_pesanan }}";
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
