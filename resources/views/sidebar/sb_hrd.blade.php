@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
@endphp
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header" style="text-align: -webkit-center;height: 120px;background:fixed">
        {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i> --}}
        <a class="" href="#" target="_blank">
            <img src="/images/logo4.png" class="img-fluid w-60 p-2 mb-3" alt="main_logo">
            {{-- <span class="ms-1 font-weight-bold">SIAGA</span> --}}
        </a>
    </div>
    <hr class="horizontal dark mt-4">
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'home.dashboard' ? 'active' : '' }}" href="/dashboard">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'jadwalmenu' ? 'active' : '' }}" href="jadwal-menu">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-open text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'datamenu' ? 'active' : '' }}" href="/data-menu">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-open text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Menu</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Pesanan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'riwayatpesanan' ? 'active' : '' }}" href="/riwayat-pesanan">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-shopping text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'permintaanpesanan' ? 'active' : '' }}"
                    href="/permintaan-pesanan">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-arrow-down text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Permintaan Pesanan</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Laporan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'datamakan' ? 'active' : '' }}" href="/data-makan">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-lines text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Makan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
