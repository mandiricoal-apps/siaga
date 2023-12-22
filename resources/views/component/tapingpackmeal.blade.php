@extends('layout.layout_taping')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 text">
                <div class="card-header pb-0 ">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 fw-bold fs-4"></p>
                    </div>
                </div>
                <div class="card-body" style="margin: 3%">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="fw-bold fs-5 text-dark " id="tanggal"></p>
                                                <p class="fw-bold fs-5 text-dark " id="jam"></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <hr class="horizontal dark mb-3 mt-4"> --}}
                        </div>
                    </div>
                    <div class="tapping-content">
                        <form action="/proses-packmeal" id="form-taping" method="POST">
                            @csrf
                            <div class="row" id="tapping-prasmanan" style="display: block;">
                                <div class="col-md-12 mb-1">
                                    <div class="card-header pb-0 text-center">
                                        <p class="mb-0 fw-bold fs-5 text-center">Tapping Packmeal</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="search" id="rfidInput"
                                            placeholder="ID Card" style="width: 100%">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible fade show text-white text-xs"
                                        id="error-alert" role="alert" hidden>
                                        <span class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                        <span class="alert-text" id="pesan-error"></span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nik" class="form-control-label text-lg">NIK</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-md" type="text" id="nikField"
                                                    placeholder="NIK" name="nik" style="width: 100%" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nama" class="form-control-label text-lg">Nama</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-md" type="text" id="namaField"
                                                    placeholder="Nama" style="width: 100%" name="nama" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="shift" class="form-control-label text-lg">Shift</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-md" type="text" id="shiftField"
                                                    placeholder="Shift" style="width: 100%" name="shift" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="tanggal_waktu" class="form-control-label text-lg">Tanggal dan
                                                    Waktu</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-md" type="text"
                                                    id="tanggalWaktuField" placeholder="Tanggal / Waktu"
                                                    name="tanggalwaktu" style="width: 100%" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="lokasi" class="form-control-label text-lg">Lokasi</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-md" type="text"
                                                    id="lokasiField" placeholder="Lokasi" style="width: 100%"
                                                    value="{{ $lokasi }}" name="lokasi" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <script>
        window.onload = function() {
            const inputField = document.getElementById("rfidInput");
            if (inputField) {
                inputField.focus();
            }
        };

        function updateClock() {
            const tanggalElement = document.getElementById('tanggal');
            const jamElement = document.getElementById('jam');
            const sekarang = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            };
            const formattedDate = sekarang.toLocaleString('id-ID', options);

            const years = sekarang.getYear();
            const months = sekarang.getMonth();
            const days = sekarang.getDay();
            const jam = sekarang.getHours();
            const menit = sekarang.getMinutes();
            const detik = sekarang.getSeconds();
            const formattedHours = jam < 10 ? "0" + jam : jam;
            const formattedMinutes = menit < 10 ? "0" + menit : menit;
            const formattedSeconds = detik < 10 ? "0" + detik : detik;

            const waktu = ` ${jam}:${formattedMinutes}:${formattedSeconds}`;
            const tanggal = `${formattedDate}`
            tanggalElement.innerText = tanggal + " " + waktu;
        }

        // Perbarui jam setiap detik (1000 milidetik)
        setInterval(updateClock, 1000);

        // Panggil fungsi untuk pertama kali agar jam ditampilkan segera
        updateClock();
    </script>
    <script>
        // Event listener untuk input RFID
        const rfidInput = document.getElementById("rfidInput");
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();


        rfidInput.addEventListener("input", function() {
            // Ambil nilai yang dimasukkan dalam input RFI
            delay(function() {
                if ($("#rfidInput").val().length < 24) {
                    $("#rfidInput").val("");
                }
            }, 500);
            const enteredRFID = rfidInput.value;
            // URL ke file JSON
            const jsonURL = '/data/karyawan.json'; // Sesuaikan dengan struktur folder Anda

            $.getJSON(jsonURL, function(data) {
                // Cari data dengan RFID yang sesuai
                const employeeData = data.find(employee => employee.rfid === enteredRFID);
                if (enteredRFID.length === 24) {
                    if (employeeData) {
                        // Jika ada kecocokan, tampilkan data JSON di field yang sesuai
                        displayEmployeeData(employeeData);
                    } else {
                        // Jika tidak ada kecocokan, hapus tampilan data JSON
                        clearEmployeeData();
                        document.getElementById('pesan-error').innerHTML = "Data Tidak Valid. Silahkan Melakukan Taping Lagi!";
                        $('#error-alert').prop('hidden', false);
                        setTimeout(() => {

                            $('#error-alert').prop('hidden', true);
                        }, 6000);
                        rfidInput.value = "";
                    }
                }
            });
        });

        // Fungsi untuk menampilkan data karyawan di field yang sesuai
        function displayEmployeeData(data) {
            const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            console.log(timeZone);
            const currentDate = new Date();
            console.log(currentDate);
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            };

            const formattedDate = currentDate.toLocaleString('id-ID', options);
            const hours = currentDate.getHours();
            const minutes = currentDate.getMinutes();
            const seconds = currentDate.getSeconds();
            const formattedHours = hours < 10 ? "0" + hours : hours;
            const formattedSeconds = seconds < 10 ? "0" + seconds : seconds;
            const formattedMinutes = minutes < 10 ? "0" + minutes : minutes;

            const formattedDateTime = formattedDate + " " + hours + ":" + minutes + ":" + formattedSeconds;

            const time1 = new Date(2023, 11, 7, 05, 30);
            const time2 = new Date(2023, 11, 7, 08, 30);
            const time3 = new Date(2023, 11, 7, 11, 30);
            const time4 = new Date(2023, 11, 7, 13, 30);
            const time5 = new Date(2023, 11, 7, 16, 30);
            const time6 = new Date(2023, 11, 7, 20, 30);

            console.log(hours);

            let shift;

            if (hours <= time2.getHours() && hours >= time1.getHours()) {
                shift = "Pagi";
            } else if (hours <= time4.getHours() && hours >= time3.getHours()) {
                shift = "Siang";
            } else if (hours <= time6.getHours() && hours >= time5.getHours()) {
                shift = "Malam";
            }

            console.log(shift);

            document.getElementById("nikField").value = data.nik;
            document.getElementById("namaField").value = data.nama_lengkap;
            document.getElementById("shiftField").value = shift;
            document.getElementById("tanggalWaktuField").value = formattedDateTime;
            document.getElementById("lokasiField").value = document.getElementById("lokasiField").value;

            rfidInput.value = "";

            document.getElementById('form-taping').submit();

        }

        // Fungsi untuk menghapus tampilan data karyawan
        function clearEmployeeData() {
            document.getElementById("nikField").value = "";
            document.getElementById("namaField").value = "";
            document.getElementById("shiftField").value = "";
            document.getElementById("tanggalWaktuField").value = "";
            document.getElementById("lokasiField").value = document.getElementById("lokasiField").value;
        }
    </script>
@endsection


