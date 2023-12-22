<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
@endphp
<!-- Navbar -->
<style>
    .badge-circle {
        width: 25px;
        /* Atur lebar dan tinggi untuk membuat badge menjadi lingkaran */
        height: 25px;
        border-radius: 50%;
        /* Mengatur sudut lengkung menjadi 50% untuk membuatnya menjadi lingkaran */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Opsional: gaya saat item dihover */
    .scrollable-list li:hover {
        background-color: #f4f4f4;
    }
</style>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        @yield('bread')
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav  justify-content-end ">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer fa-xl" style="position: relative;"></i>
                            <span class="badge badge-light badge-xs text-white badge-circle"
                                style="position: absolute; top: -5px; right: -10px;background-color: #f0375c !important">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 scrollable-list"
                            aria-labelledby="dropdownMenuButton" style="max-height: 300px;overflow-y:auto; top:0rem !important;right: 1.0rem !important">
                            {{-- @if (auth()->user()->unreadNotifications)
                                <div class="bg-white" style="position: sticky; top:0;z-index:100">
                                    <li class="d-flex justify-content-end">
                                        <a href="{{ route('mark-as-read') }}" class="btn btn-secondary btn-xs">Mark All
                                            as
                                            Read</a>
                                    </li>
                                </div>
                            @endif --}}
                            <span class="text-dark fw-bold text-lg" style="margin-bottom: 50%">Notifikasi!</span>
                            @if (auth()->user()->unreadNotifications->count() == 0)
                                <a class="dropdown-item border-radius-md mt-3" href="javascript:;"
                                    style="background-color: #F5F7F8">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <small class="fo    nt-weight-bold text-danger"
                                                    style="font-style: italic">
                                                    Pesan Notifikasi Masih Kosong</small>
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            @else
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li class="mb-2 mt-3">
                                        <a class="notification-link dropdown-item border-radius-md"
                                            href="{{ route('read.notification', ['id' => $notification->id]) }}"
                                            style="background-color: #F5F7F8"
                                            data-notification-id="{{ $notification->id }}">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-xs mb-1">
                                                    <span
                                                        class="font-weight-bold">{{ $notification->data['data'] }}</span>
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock fa-xs me-1"></i>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    {{-- <hr class="horizontal dark"> --}}
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center ms-3"
                        style="border: solid 1px;border-color: white; border-radius: 10px;">
                        <a href="javascript:;" class="nav-link text-white p-0 ms-4 me-4" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                    <i class="fa fa-user cursor-pointer"></i>
                                </div>
                                <div class="d-flex flex-column justify-content-center ms-2">
                                    <h6 class="text-sm font-weight-normal mb-1 text-white">
                                        <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                                    </h6>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownMenuButton"
                            style="border: solid 2px; border-color: white; border-radius: 10px;">
                            <li class="dropdown-item border-0 mb-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="" href="/profile">
                                                <div class="icon icon-shape icon-sm mt-2 mb-1">
                                                    <i class="fa-solid fa-user text-lg opacity-10 text-dark"></i>
                                                </div>
                                                <span class="nav-link-text mx-1">Profile</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="horizontal-divider"></li>
                            <li class="dropdown-item border-0 mb-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                <div class="icon icon-shape icon-sm mt-2 mb-1">
                                                    <i class="fa-solid fa-sign-out text-lg opacity-10 text-dark"></i>
                                                </div>
                                                <span class="nav-link-text mx-1">Keluar</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('.notification-link').on('click', function(e) {
            e.preventDefault(); // Mencegah tindakan default dari hyperlink

            var notificationId = $(this).data('notification-id');
            console.log(notificationId);
            // Kirim permintaan ke endpoint yang menandai notifikasi sebagai telah dibaca
            $.get('/read-notification/' + notificationId, function(response) {
                // Tambahkan logika jika diperlukan setelah notifikasi ditandai sebagai telah dibaca
                console.log('Notifikasi telah dibaca');
            });

            // Lanjutkan untuk mengarahkan pengguna ke halaman yang ditautkan dalam notifikasi
            window.location.href = $(this).attr('href');
        });
    });
</script>
<!-- End Navbar -->
