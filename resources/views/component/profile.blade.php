<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

<div class="container-fluid py-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="card card-profile">
                <div class="row justify-content-center">
                    <div class="col-2 col-lg-2 order-lg-2">
                        <div class="mt-n2 mt-lg-n7 mb-4 mb-lg-0">
                            <img src="../images/profile3.png"
                                class="rounded-circle img-fluid border border-2 border-white bg-brown">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-2 col-lg-12 order-lg-2 mt-2">
                        <div class="row text-center">
                            <div class="mt-n4 mt-lg-n1 mb-4 mb-lg-0">
                                <h5>
                                    <span class="font-weight-bold">{{ $user->name }}</span>
                                </h5>
                            </div>
                            <div class="d-flex mt-n4 mt-lg-n1 mb-4 mb-lg-0" style="justify-content: center">
                                <div class="text-xs text-dark">
                                    <span class="font-weight-bold">email</span> : <span
                                        class="font-weight-light">{{ $user->email }}</span>
                                </div>
                                <div class="text-xs text-dark" style="margin-left: 3%">
                                    <span class="font-weight-bold">phone</span> : <span
                                        class="font-weight-light">{{ $user->no_telp }}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="fw-bold"><span class="text-md text-secondary"
                                style="vertical-align: top;margin-left:5%">
                                Data Pengguna
                        </p>
                        <div class="row text-dark">
                            <div class="col-6">
                                <div class="d-flex col-12 mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        NIK
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->nik)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->nik }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Nama
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->name)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Email
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->email)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Perusahaan
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->no_telp)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->no_telp }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex col-12 mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Jabatan
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->level)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->level }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Divisi
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->divisi)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->divisi }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Departemen
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->departemen)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->departemen }}
                                    </div>
                                </div>
                                <div class="d-flex col-12  mb-3">
                                    <div class="col-md-6 fw-bold text-center">
                                        Perusahaan
                                    </div>
                                    <div class="col-md-6">
                                        @empty($user->perusahaan)
                                            <span class="font-weight-light text-sm text-danger"
                                                style="font-style: italic">Tidak ada</span>
                                        @endempty
                                        {{ $user->perusahaan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="fw-bold"><span class="text-md text-secondary"
                                style="vertical-align: top;margin-left:5%">
                                Ubah Password
                        </p>
                        <form action="/update-password" method="post" class="mb-4" id="form-upassword">
                            @csrf
                            <div class="row text-dark">
                                <div class="col-4" style="margin-left: 5%">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            <span class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Password Baru</label>
                                        <input class="form-control" type="password" name="password" id="password"
                                            placeholder="Masukkan password baru">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">
                                            <span class="text-xxs" style="vertical-align: top;"><i
                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                            Konfirmasi Password Baru</label>
                                        <input class="form-control" type="password" name="password_konfirmasi"
                                            id="password_konfirmasi" placeholder="Masukkan lagi password baru">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-sm bg-gradient-warning" type="button"
                                        onclick="showConfirmation()" style="margin-top: 23%">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showConfirmation() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengubah password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-upassword').submit();
            }
        });
    }
</script>
