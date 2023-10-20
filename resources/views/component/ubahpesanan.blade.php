<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"> Form Ubah Pesanan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Pilih Menu</label>
                                <select class="form-control" aria-label="Default select example">
                                    <option disabled>Pilih Menu</option>
                                    <option value="1">Snack</option>
                                    <option selected value="2">Menu Spesial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jumlah Pesanan</label>
                                <input class="form-control" type="number" value="20">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Pemesan</label>
                                <input class="form-control" type="text" value="Departemen">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tanggal Pesanan</label>
                                <input class="form-control" type="date" value="2023-09-24">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="detail_karyawan" class="form-control-label">Nama Penerima</label>
                                <select class="selectpicker form-control-md col-12" multiple data-live-search="true"
                                    name="detail_karyawan[]" id="detail_karyawan">
                                    <option value="Putih" selected>NIK - Nama Karyawan 1</option>
                                    <option value="Hitam"selected>NIK - Nama Karyawan 2</option>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Catatan</label>
                                <textarea class="form-control" rows="4" cols="50">Catatan Pesanan</textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                </div>
                <div class="card-header pb-0 mb-5">
                    <div class="d-flex align-items-center">
                        @yield('btn-edit-pesanan')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
