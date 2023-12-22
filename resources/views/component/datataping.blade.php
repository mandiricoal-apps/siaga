<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
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
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h5>Table Data Taping</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('export.datamakan', request()->query()) }}" method="GET"
                                id="filter-taping">
                                {{-- <p for="example-text-input" class="text-md text-center">Filter Data Taping</p> --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label dateselect"><span
                                                    class="text-xxs" style="vertical-align: top;"><i
                                                        class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                Awal</label>
                                            <input class="form-control bg-white" type="date" placeholder="dd/mm/yy  -- : --"
                                                id="min" name="min" required>
                                            @if ($errors->has('min'))
                                                <span class="text-danger text-xs">{{ $errors->first('min') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label dateselect"><span
                                                    class="text-xxs" style="vertical-align: top;"><i
                                                        class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>Tanggal
                                                Akhir</label>
                                            <input class="form-control bg-white" type="date" placeholder="dd/mm/yy  -- : --"
                                                id="max" name="max" required>
                                            @if ($errors->has('max'))
                                                <span class="text-danger text-xs">{{ $errors->first('max') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="example-text-input"
                                            class="form-control-label dateselect col-12"></label>
                                        <a class="btn btn-sm ms-auto bg-dark text-white mt-2" type="button"
                                            onclick="dataExport()">
                                            <i class="text-sm fa-solid fa-file-excel"
                                                style="margin-right: 10px"></i>Export to Excel</a>
                                        <script>
                                            // Fungsi untuk menampilkan konfirmasi sebelum menambah data
                                            function dataExport() {
                                                document.getElementById('filter-taping').submit();
                                            }
                                        </script>
                                    </div>
                                </div>

                            </form>
                            <script>
                                $("#min, #max").flatpickr({
                                    dateFormat: "Y-m-d"
                                });
                            </script>
                            <hr class="horizontal dark">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="data-taping">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NIK</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Shift Makan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kategori
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Lokasi
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal & Waktu
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($taping as $data)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->nik }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->nama }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->shift }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->kategori }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->lokasi }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $data->tanggalwaktu }}</span>
                                                </td>
                                            </tr>
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
        var table = $('#data-taping').DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100],
            "order": [
                [5, "desc"]
            ],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ Data per halaman",
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
                "dom": 'lrtip',
                "columnDefs": [{
                        type: 'date',
                        targets: 5
                    } // Sesuaikan dengan indeks kolom tanggal Anda
                ],
            },

        });
        $('#min, #max').on('change', function() {
            var minDate = $('#min').val();
            var maxDate = $('#max').val();

            console.log(minDate, maxDate);

            table.columns(5).search('')
                .draw(); // Reset pencarian sebelum menyesuaikan dengan rentang tanggal baru

            $.fn.dataTable.ext.search.pop(); // Menghapus fungsi pencarian sebelum menambah yang baru
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var currentDate = new Date(data[
                        5]); // Mengambil nilai tanggal pada kolom keenam (indeks 5)
                    var selectedDate = new Date(minDate);
                    if (isNaN(selectedDate.getTime()))
                        return true; // Jika tidak ada tanggal yang dipilih, tampilkan semua data

                    if (minDate && !maxDate) {
                        return currentDate >= selectedDate;
                    } else if (!minDate && maxDate) {
                        return currentDate <= new Date(maxDate);
                    } else {
                        var endDate = new Date(maxDate);
                        endDate.setDate(endDate.getDate() + 1);
                        return currentDate > selectedDate && currentDate <= endDate;
                    }
                }
            );

            table.draw();
        });

        // Reset filter saat salah satu input dikosongkan
        $('#min, #max').on('keyup', function() {
            if ($('#min').val() === '' && $('#max').val() === '') {
                table.columns(5).search('').draw();
            }
        });
    });
</script>

