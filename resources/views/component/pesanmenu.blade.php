<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"> Form Permintaan Pesanan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">
                                    <span class="text-xxs" style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Pilih
                                    Menu</label>
                                <select class="form-control" aria-label="Default select example">
                                    <option selected disabled>Pilih Menu</option>
                                    <option value="1">Snack</option>
                                    <option value="2">Menu Spesial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                        style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Jumlah
                                    Pesanan</label>
                                <input class="form-control" type="number" placeholder="Masukkan jumlah pesanan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                        style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Nama
                                    Pemesan</label>
                                <input class="form-control" type="text" placeholder="Masukkan nama ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label dateselect"><span
                                        class="text-xxs" style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                    Tanggal Pesanan</label>
                                <input class="form-control" type="datetime-local" placeholder="dd/mm/yy  -- : --">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                        style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Lokasi
                                    Pengantaran</label>
                                <input class="form-control" type="text" placeholder="Masukkan lokasi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="detail_karyawan" class="form-control-label"><span class="text-xxs"
                                        style="vertical-align: top;"><i
                                            class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Nama
                                    Penerima</label>
                                <select class="selectpicker form-control-md col-12" multiple data-live-search="true"
                                    name="detail_karyawan[]" id="detail_karyawan" style="background-color: red;">
                                    <option value="Putih">NIK - Nama Karyawan 1</option>
                                    <option value="Hitam">NIK - Nama Karyawan 2</option>
                                    <option value="Merah">NIK - Nama Karyawan 3</option>
                                    <option value="Putih">NIK - Nama Karyawan 4</option>
                                    <option value="Hitam">NIK - Nama Karyawan 5</option>
                                    <option value="Merah">NIK - Nama Karyawan 6</option>
                                    <option value="Putih">NIK - Nama Karyawan 7</option>
                                    <option value="Hitam">NIK - Nama Karyawan 8</option>
                                    <option value="Merah">NIK - Nama Karyawan 9</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Detail Peserta</label>
                                <textarea class="form-control" rows="4" cols="50" id="peserta" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Catatan</label>
                                <textarea class="form-control" rows="4" cols="50" id="catatan"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                </div>
                <div class="card-header pb-0 mb-5">
                    <div class="d-flex align-items-center">
                        @yield('btn-pesan')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendapatkan referensi elemen select
    var selectElement = document.getElementById('detail_karyawan');

    // Mendapatkan referensi elemen textarea
    var textareaElement = document.getElementById('peserta');

    // Menambahkan event listener untuk mengupdate textarea saat ada perubahan pada select
    selectElement.addEventListener('change', function() {
        // Mendapatkan semua opsi yang dipilih
        var selectedOptions = Array.from(selectElement.selectedOptions);

        // Membuat array untuk menyimpan teks opsi yang dipilih
        var selectedTexts = selectedOptions.map(function(option) {
            return option.text;
        });

        // Menyusun teks yang akan ditampilkan pada textarea, misalnya dengan memisahkannya dengan koma
        var textToDisplay = selectedTexts.join('\n');

        // Memasukkan teks yang dihasilkan ke dalam textarea
        textareaElement.value = textToDisplay;
    });
</script>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
