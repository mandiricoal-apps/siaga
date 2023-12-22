<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
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
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"> Form Ubah Data Menu</p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/data-menu-spesial/update/{{ $menus->id }}" method="POST" id="form-menu">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                            style="vertical-align: top;"><i
                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                        Nama Menu
                                        Makan</label>
                                    @php
                                        $makanan = json_decode($menus->nama_makanan, true);
                                    @endphp
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input class="form-control bg-brown text-white"
                                                type="text" value="Menu Spesial 1,5 Main Course"
                                                style="max-width: 30%">
                                            <textarea class="form-control" name="nama_makanan[]" type="text" value=""> {{ $makanan[0] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-10 mt-2">
                                        <div class="input-group">
                                            <input class="form-control bg-brown text-white"
                                                type="text" value="Menu Spesial 2,5 Main Course"
                                                style="max-width: 30%">
                                            <textarea class="form-control" name="nama_makanan[]" type="text" value=""> {{ $makanan[1] }}</textarea>
                                        </div>
                                    </div>

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
                                    <input type="date" name="tanggal" id="tanggal" class="form-control bg-white"
                                        value="{{ $menus->tanggal_berlaku }}" required>
                                    <select name="shift" class="form-select" required>
                                        <option value="Pagi"
                                            {{ in_array('Pagi', old('shift', [$menus->shift])) ? 'selected' : '' }}>
                                            Pagi</option>
                                        <option value="Siang"
                                            {{ in_array('Siang', old('shift', [$menus->shift])) ? 'selected' : '' }}>
                                            Siang</option>
                                        <option value="Malam"
                                            {{ in_array('Malam', old('shift', [$menus->shift])) ? 'selected' : '' }}>
                                            Malam</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                                $("#tanggal").flatpickr({
                                    dateFormat: "Y-m-d"
                                });
                            </script>
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
                                            document.getElementById('form-menu').submit();
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
