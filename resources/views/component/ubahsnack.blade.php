<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"> Form Ubah Data Snack</p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/catering/data-snack/update/{{ $snacks->id }}" method="POST" id="form-snack">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Nama Menu
                                        Makan</label>
                                    <input class="form-control" name="nama_makanan" type="text"
                                        value="{{ $snacks->nama_makanan }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Jenis Menu</label>
                                    <select name="jenis_makanan" class="form-select" required>
                                        <option value="1"
                                            {{ old('jenis_makanan', $snacks->jenis_makanan) == 1 ? 'selected' : '' }}>
                                            Menu Spesial</option>
                                        <option selected value="2"
                                            {{ old('jenis_makanan', $snacks->jenis_makanan) == 2 ? 'selected' : '' }}>
                                            Snack</option>>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Deskripsi</label>
                                    <textarea class="form-control" rows="4" cols="50" name="deskripsi">{{ $snacks->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm"><span class="text-xxs" style="vertical-align: top;"><i
                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span> Masa Berlaku
                        </p>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="detail_karyawan" class="form-control-label">Tanggal Berlaku</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ $snacks->tanggal_berlaku }}" required>
                                    <select name="shift" class="form-select" required>
                                        <option value="Pagi"
                                            {{ in_array('Pagi', old('shift', [$snacks->shift])) ? 'selected' : '' }}>
                                            Pagi</option>
                                        <option value="Siang"
                                            {{ in_array('Siang', old('shift', [$snacks->shift])) ? 'selected' : '' }}>
                                            Siang</option>
                                        <option value="Malam"
                                            {{ in_array('Malam', old('shift', [$snacks->shift])) ? 'selected' : '' }}>
                                            Malam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <div class="card-header pb-0 mb-5">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm ms-auto bg-gradient-warning" type="button"
                                    onclick="showConfirmation()">Simpan</button>
                            </div>

                            <script>
                                // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                function showConfirmation() {
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: 'Apakah Anda Yakin Ingin Mengubah Data Ini?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Ya',
                                        cancelButtonText: 'Batal',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('form-snack').submit();
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
