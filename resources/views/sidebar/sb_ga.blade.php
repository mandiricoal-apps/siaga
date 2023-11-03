<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#"
            target="_blank">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">SIAGA</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'home.dashboard_ga' ? 'active' : '' }}" href="/ga/dashboard">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Daftar Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'ga.datasnack' ? 'active' : '' }}" href="/ga/data-snack">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cookie-bite text-sm opacity-10" style="color:#7b5e50"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Snack</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'ga.datamenuspesial' ? 'active' : '' }}" href="/ga/data-menu-spesial">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-open text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Menu Spesial</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Pesanan</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'ga.pesanmenu' ? 'active' : '' }}" href="/ga/pesan-menu">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-plus text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pesan Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'ga.riwayatpesanan' ? 'active' : '' }}" href="/ga/riwayat-pesanan">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-shopping text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Riwayat Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'ga.permintaanpesanan' ? 'active' : '' }}" href="/ga/permintaan-pesanan">
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
                <a class="nav-link " href="#">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-lines text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Makan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-lines text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Keluar Masuk</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Pengguna</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/ga/kelola-pengguna">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kelola Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
