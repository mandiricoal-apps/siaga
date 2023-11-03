<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                <div class="col-10">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Table Snack</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="snack">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Snack</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal Berlaku</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Shift</th>
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
                                        @foreach ($snack as $msnack)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $msnack->nama_makanan }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                        $dates = $msnack->tanggal_berlaku;
                                                        $timestamp = strtotime($dates);
                                                        $date = date('d F Y', $timestamp);
                                                    @endphp
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $date }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $msnack->shift }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($tgl_berlaku < $msnack->tanggal_berlaku)
                                                        <span class="badge badge-sm bg-gradient-warning"
                                                            style="width: 70%; height: 100%;">Soon</span>
                                                    @endif
                                                    @if ($tgl_berlaku == $msnack->tanggal_berlaku)
                                                        <span class="badge badge-sm bg-gradient-success"
                                                            style="width: 70%; height: 100%;">Available</span>
                                                    @endif
                                                    @if ($tgl_berlaku > $msnack->tanggal_berlaku)
                                                        <span class="badge badge-sm bg-gradient-danger"
                                                            style="width: 70%; height: 100%;">Expired</span>
                                                    @endif

                                                </td>

                                                <td class="align-middle">
                                                    <a type="button"
                                                        class="fa-solid fa-eye text-s badge badge-md bg-gradient-info"
                                                        data-toggle="tooltip" data-original-title="Detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $msnack->id }}">
                                                        <a href="/catering/data-snack/ubah/{{$msnack->id}}"
                                                            class="text-secondary text-s" data-toggle="tooltip"
                                                            data-original-title="Edit">
                                                            <span class="badge badge-md bg-gradient-warning"><i
                                                                    class="fa-solid fa-square-pen"></i><span>
                                                        </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="exampleModal{{ $msnack->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content m-5">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Detail
                                                                Snack</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Nama Snack</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    {{$msnack->nama_makanan}}
                                                                </p>

                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg  text-dark">Tanggal Berlaku</p>
                                                                <p class="text-muted mb-0 text-md">
                                                                    @php
                                                                        $tgl = $msnack->tanggal_berlaku;
                                                                        $timestamp = strtotime($tgl);
                                                                        $formattedDate = date('d F Y', $timestamp)
                                                                    @endphp
                                                                    {{ $formattedDate }}</p>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Waktu Pesanan</p>
                                                                @if ($msnack->shift == 'Pagi')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        07.00 - 12.00 WIB </p>
                                                                @endif
                                                                @if ($msnack->shift == 'Siang')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        12.00 - 17.00 WIB </p>
                                                                @endif
                                                                @if ($msnack->shift == 'Malam')
                                                                    <p class="text-muted mb-0 text-md">
                                                                        17.00 - 20.00 WIB </p>
                                                                @endif
                                                            </div>
                                                            <div class="row justify-content-between mb-3">
                                                                <p class="fw-bold mb-0 text-lg text-dark">Deskripsi</p>
                                                                <p class="text-muted mb-0 text-md">{{ $msnack->deskripsi }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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
