<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

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

    .bootstrap-select .dropdown-menu.inner {
        max-height: 200px;
    }
</style>

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
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card-header pb-0">
                        <div class=" align-items-center">
                            <a class="btn btn-sm ms-auto bg-gradient-success" type="button" class=""
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-plus" style="margin-right: 10px"></i>Tambah Data Pengguna</a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tabel Pengguna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="snack">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Pengguna</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Level</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Departemen
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Perusahaan
                                            </th>
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
                                        @foreach ($pengguna as $user)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @empty($user->name)
                                                            <i class="text-lg fw-lighter text-dark">-</i>
                                                        @else
                                                            {{ $user->name }}
                                                        @endempty
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->email }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @empty($user->level)
                                                            <i class="text-lg fw-lighter text-dark">-</i>
                                                        @else
                                                            {{ $user->level }}
                                                        @endempty
                                                    </span>

                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @empty($user->departemen)
                                                            <i class="text-lg fw-lighter text-dark">-</i>
                                                        @else
                                                            {{ $user->departemen }}
                                                        @endempty
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @empty($user->perusahaan)
                                                            <i class="text-lg fw-lighter text-dark">-</i>
                                                        @else
                                                            {{ $user->perusahaan }}
                                                        @endempty
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($user->status == 'Aktif')
                                                        <span class="badge badge-sm bg-gradient-success"
                                                            style="width: 70%; height: 100%;">{{ $user->status }}</span>
                                                    @endif
                                                    @if ($user->status == 'Non-Aktif')
                                                        <span class="badge badge-sm bg-gradient-danger"
                                                            style="width: 70%; height: 100%;">{{ $user->status }}</span>
                                                    @endif
                                                </td>

                                                <td class="align-middle">
                                                    <a type="button"
                                                        class="fa-solid fa-eye text-s badge badge-md bg-gradient-info"
                                                        data-toggle="tooltip" data-original-title="Detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#tambahPengguna{{ $user->id }}">
                                                        <a type="button"
                                                            class="fa-solid fa-square-pen text-s badge badge-md bg-gradient-warning"
                                                            data-toggle="tooltip" data-original-title="Detail"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ubahPengguna{{ $user->id }}"
                                                            style="margin-left: 10%" </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade modal-md" id="tambahPengguna{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content m-5">
                                                        <div class="d-flex modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Detail
                                                                Pengguna</h4>
                                                            @if ($user->status == 'Aktif')
                                                                <p class="badge badge-sm text-xxs bg-gradient-success m-1"
                                                                    style="width: 30%; height: 100%;">
                                                                    {{ $user->status }}</p>
                                                            @else
                                                                <p class="badge badge-sm text-xxs bg-gradient-danger"
                                                                    style="width: 30%; height: 100%;">
                                                                    {{ $user->status }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Nama</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $user->name }}
                                                                </p>

                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg  text-dark">Email</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{ $user->email }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Level</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @empty($user->level)
                                                                        <i class="text-xs fw-lighter text-dark">Kosong</i>
                                                                    @else
                                                                        {{ $user->level }}
                                                                    @endempty
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Departemen
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @empty($user->departemen)
                                                                        <i class="text-xs fw-lighter text-dark">Kosong</i>
                                                                    @else
                                                                        {{ $user->departemen }}
                                                                    @endempty
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Perusahaan
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @empty($user->perusahaan)
                                                                        <i class="text-xs fw-lighter text-dark">Kosong</i>
                                                                    @else
                                                                        {{ $user->perusahaan }}
                                                                    @endempty
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">No.Telepon
                                                                </p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @empty($user->no_telp)
                                                                        <i class="text-xs fw-lighter text-dark">Kosong</i>
                                                                    @else
                                                                        {{ $user->no_telp }}
                                                                    @endempty
                                                                </p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Role</p>
                                                                <p class="text-muted mb-0 text-sm text-uppercase">
                                                                    @empty($user->id_role)
                                                                        <i class="text-xs fw-lighter text-dark">Kosong</i>
                                                                    @else
                                                                        {{ $user->role }}
                                                                    @endempty
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade modal-lg" id="ubahPengguna{{ $user->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3
                                                                        class="font-weight-bolder text-gradient text-dark">
                                                                        Form
                                                                        Ubah Pengguna</h3>
                                                                    <p class="mb-0">Ubah form dibawah untuk
                                                                        melakukan update data pengguna !</p>
                                                                </div>
                                                                <div class="card-body pb-3">
                                                                    <form role="form text-left"
                                                                        id="form-ubah-pengguna{{ $user->id }}"
                                                                        method="POST"
                                                                        action="/ga/proses-ubah-pengguna/{{ $user->id }}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        NIK</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="unik{{ $user->id }}"
                                                                                        id="unik{{ $user->id }}"
                                                                                        value="0123456789101" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Nama</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="unamal{{ $user->id }}"
                                                                                        id="unamal{{ $user->id }}"
                                                                                        value="{{ $user->name }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Email</label>
                                                                                    <input class="form-control"
                                                                                        type="email"
                                                                                        name="uemail{{ $user->id }}"
                                                                                        id="uemail{{ $user->id }}"
                                                                                        value="{{ $user->email }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Jabatan</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="ulevel{{ $user->id }}"
                                                                                        id="ulevel{{ $user->id }}"
                                                                                        value="{{ $user->level }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Departemen</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="udepartemen{{ $user->id }}"
                                                                                        id="udepartemen{{ $user->id }}"
                                                                                        value="{{ $user->departemen }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Perusahaan</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="uperusahaan{{ $user->id }}"
                                                                                        id="uperusahaan{{ $user->id }}"
                                                                                        value="{{ $user->perusahaan }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        No.Telepon</label>
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        name="uno_telp{{ $user->id }}"
                                                                                        id="uno_telp{{ $user->id }}"
                                                                                        value="{{ $user->no_telp }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <hr class="horizontal dark">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Role</label>
                                                                                    <select
                                                                                        class="form-control col-12 "
                                                                                        name="urole{{$user->id}}" id="urole{{$user->id}}"
                                                                                        data-placeholder="Pilih Role"
                                                                                        data-live-search="true"
                                                                                        style="z-index: 2000">
                                                                                        <option selected disabled
                                                                                            class="text-muted"
                                                                                            value="0">
                                                                                            @if ($user->id_role == 1)
                                                                                                departemen
                                                                                            @endif
                                                                                            @if ($user->id_role == 2)
                                                                                                catering
                                                                                            @endif
                                                                                            @if ($user->id_role == 3)
                                                                                                hrd
                                                                                            @endif
                                                                                            @if ($user->id_role == 4)
                                                                                                ga
                                                                                            @endif

                                                                                        </option>
                                                                                        @foreach ($roles as $role)
                                                                                            <option
                                                                                                class="text-uppercase"
                                                                                                value="{{ $role['id'] }}">
                                                                                                {{ $role['role'] }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="example-text-input"
                                                                                        class="form-control-label">
                                                                                        <span class="text-xxs"
                                                                                            style="vertical-align: top;"><i
                                                                                                class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                                        Status</label>
                                                                                    <select
                                                                                        class="form-control col-12 "
                                                                                        name="status{{ $user->id }}"
                                                                                        id="status{{ $user->id }}"
                                                                                        data-placeholder="Pilih Role"
                                                                                        data-live-search="true"
                                                                                        style="z-index: 2000">
                                                                                        <option selected disabled
                                                                                            class="text-muted"
                                                                                            value="0">
                                                                                            {{ $user->status }}
                                                                                        </option>
                                                                                        <option value="Aktif">
                                                                                            Aktif
                                                                                        </option>
                                                                                        <option value="Non-Aktif">
                                                                                            Non-Aktif
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr class="horizontal dark">
                                                                        <div class="card-header pb-0 mb-5">
                                                                            <div class="d-flex align-items-center">
                                                                                @yield('btn-ubah')
                                                                            </div>
                                                                        </div>
                                                                        <script>
                                                                            // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                            function ushowConfirmation() {
                                                                                Swal.fire({
                                                                                    title: 'Konfirmasi',
                                                                                    text: 'Apakah Anda Yakin Ingin Mengubah Data Ini?',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.isConfirmed) {
                                                                                        document.getElementById('form-ubah-pengguna' + @json($user->id)).submit();
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

                                <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                        <h3 class="font-weight-bolder text-gradient text-dark">Form
                                                            Tambah Pengguna</h3>
                                                        <p class="mb-0">Lengkapi form dibawah untuk melakukan tambah
                                                            pengguna!</p>
                                                    </div>
                                                    <div class="card-body pb-3">
                                                        <form role="form text-left" id="form-pengguna" method="POST"
                                                            action="/ga/proses-tambah-pengguna">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="detail_karyawan"
                                                                            class="form-control-label"><span
                                                                                class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Nama Pengguna</label>
                                                                        <select
                                                                            class="selectpicker form-control col-12"
                                                                            name="nama_pengguna" id="nama_pengguna"
                                                                            data-placeholder="Pilih nama pengguna"
                                                                            data-live-search="true">
                                                                            <option selected disabled
                                                                                class="text-muted text-xs"
                                                                                value="0">Pilih pengguna
                                                                            </option>
                                                                            @foreach ($karyawan as $data)
                                                                                <option value="{{ $data['nik'] }}">
                                                                                    {{ $data['nik'] }} -
                                                                                    {{ $data['nama_lengkap'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" hidden>
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Password</label>
                                                                        <input class="form-control" type="password"
                                                                            name="password" id="password" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            NIK</label>
                                                                        <input class="form-control" type="text"
                                                                            name="nik" id="nik" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Nama</label>
                                                                        <input class="form-control" type="text"
                                                                            name="namal" id="namal" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Email</label>
                                                                        <input class="form-control" type="email"
                                                                            name="email" id="email" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Jabatan</label>
                                                                        <input class="form-control" type="text"
                                                                            name="level" id="level" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Departemen</label>
                                                                        <input class="form-control" type="text"
                                                                            name="departemen" id="departemen"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Perusahaan</label>
                                                                        <input class="form-control" type="text"
                                                                            name="perusahaan" id="perusahaan"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            No.Telepon</label>
                                                                        <input class="form-control" type="text"
                                                                            name="no_telp" id="no_telp" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="example-text-input"
                                                                            class="form-control-label">
                                                                            <span class="text-xxs"
                                                                                style="vertical-align: top;"><i
                                                                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                                                                            Role</label>
                                                                        <select class="form-control col-12 "
                                                                            name="role" id="role"
                                                                            data-placeholder="Pilih Role"
                                                                            data-live-search="true"
                                                                            style="z-index: 2000">
                                                                            <option selected disabled
                                                                                class="text-muted" value="0">
                                                                                Pilih role pengguna
                                                                            </option>
                                                                            @foreach ($roles as $role)
                                                                                <option class="text-uppercase"
                                                                                    value="{{ $role['id'] }}">
                                                                                    {{ $role['role'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr class="horizontal dark">
                                                            <div class="card-header pb-0 mb-5">
                                                                <div class="d-flex align-items-center">
                                                                    @yield('btn-tambah')
                                                                </div>
                                                            </div>
                                                            <script>
                                                                // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                                                function showConfirmation() {
                                                                    Swal.fire({
                                                                        title: 'Konfirmasi',
                                                                        text: 'Apakah Anda Yakin Ingin Menambah Data Ini?',
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonText: 'Ya',
                                                                        cancelButtonText: 'Batal',
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('form-pengguna').submit();
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk nama pengguna


        // Tambahkan event listener untuk perubahan pada elemen "Nama Pengguna"
        $("#nama_pengguna").on("change", function() {
            var selectedNik = this.value;
            console.log(selectedNik);
            // Dapatkan data karyawan yang sesuai dari JSON
            var selectedKaryawan = karyawanData.find(function(karyawan) {
                return karyawan.nik === selectedNik;
            });

            // Isi input lainnya dengan data karyawan yang sesuai
            if (selectedKaryawan) {
                $("input[name='password']").val(selectedKaryawan.password);
                $("input[name='nik']").val(selectedKaryawan.nik);
                $("input[name='namal']").val(selectedKaryawan.nama_lengkap);
                $("input[name='email']").val(selectedKaryawan.email);
                $("input[name='level']").val(selectedKaryawan.jabatan);
                $("input[name='departemen']").val(selectedKaryawan.departement);
                $("input[name='perusahaan']").val(selectedKaryawan.perusahaan);
                $("input[name='no_telp']").val(selectedKaryawan.no_hp);
            }
        });
    });

    // Data karyawan dari karyawan.json
    var karyawanData;

    // Mengambil data karyawan dari file JSON
    $.getJSON('{{ asset('/data/karyawan.json') }}', function(data) {
        karyawanData = data;
    });
</script>

<script>
    $(document).ready(function() {
        $('#snack').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ Data per halaman",
                "zeroRecords": "Maaf, tidak dapat menemukan apapun",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Menampilkan halaman _PAGES_ dari _PAGES_ halaman",
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
