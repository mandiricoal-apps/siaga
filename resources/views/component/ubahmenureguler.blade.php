<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
<div class="container-fluid py-4 mt-3">
    <div class="row justify-content-center">
        <div class="col-10 text">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"> Form Ubah Data Menu Reguler</p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/data-menu-reguler/update/{{ $menur->id }}" method="POST" id="form-reguler">
                        @csrf

                        @php
                            $makanan = json_decode($menur->nama_makanan, true);
                            $no = 1;
                        @endphp
                        <label for="example-text-input" class="form-control-label"><span class="text-xxs"
                                style="vertical-align: top;"><i
                                    class="fa-solid fa-star-of-life fa-2xs mb-1 text-danger"></i></span>
                            Nama Menu
                            Makan</label>
                        <div class="col-md-4">
                            <a class="btn btn-sm ms-auto bg-gradient-success add-input" type="button"
                                class="btn btn-success text-lg add-input">
                                <i class="fa-solid fa-circle-plus" style="margin-right: 10px"></i>Tambah Nama Menu Reguler</a>
                        </div>
                        <div class="row" id="input-container">
                            @foreach ($makanan as $data)
                                <div class="col-md-6 tambahan-input">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-md-10">
                                                <input class="form-control" name="nama_makanan[]" type="text"
                                                    value="{{ $data }}">
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button"
                                                    class="btn btn-danger text-lg fa-solid fa-circle-xmark remove-input"
                                                    title="Hapus Field"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <script>
                                $('.add-input').click(function() {
                                    var newInput ='<div class="col-md-6 tambahan-input"><div class="form-group"><div class="input-group"><div class="col-md-10"><input class="form-control" name="nama_makanan[]" type="text"value=""></div><div class="col-md-2"><a type="button"class="btn btn-danger text-lg fa-solid fa-circle-xmark remove-input" title="Hapus Field"></a></div></div></div></div>';
                                    $('#input-container').append(newInput);
                                });
                                $('#input-container').on('click', '.remove-input', function() {
                                    $(this).closest('.tambahan-input').remove();
                                });
                            </script>
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
                                        value="{{ $menur->tanggal_berlaku }}" required>
                                    <select name="shift" class="form-select" required>
                                        <option value="{{$menur->shift}}">
                                            {{$menur->shift}}</option>
                                        <option value="Pagi">
                                            Pagi</option>
                                        <option value="Siang">
                                            Siang</option>
                                        <option value="Malam">
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
                                            document.getElementById('form-reguler').submit();
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
