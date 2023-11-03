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
                <a class="nav-link {{ Route::currentRouteName() === 'home.dashboard_catering' ? 'active' : '' }}" href="/catering/dashboard">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'catering.tambahmenu' ? 'active' : '' }}" href="/catering/tambah-menu">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-medical text-sm opacity-10 text-secondary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'catering.kelolasnack' ? 'active' : '' }}" href="/catering/data-snack">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cookie-bite text-sm opacity-10" style="color:#7b5e50"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Snack</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'catering.kelolamenuspesial' ? 'active' : '' }}" href="/catering/data-menu-spesial">
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
                <a class="nav-link " {{ Route::currentRouteName() === 'catering.datapesanan' ? 'active' : '' }}" href="/catering/data-pesanan">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-shopping text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Pesanan</span>
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
        </ul>
    </div>
</aside>
