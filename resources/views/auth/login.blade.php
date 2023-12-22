@php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/images/logo5.jpg">
    <title>
        Siaga
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <script src="{{ asset('https://kit.fontawesome.com/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('https://kit.fontawesome.com/0fe5c30090.js') }}" crossorigin="anonymous"></script>
    <style>
        .card {
            border-radius: 30px;
        }

        .bg-brown {
            background-color: #7b5e50 !important;
        }
    </style>
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-90">
                <div class="container">
                    <div class="row" style="justify-content: center">
                        @if ($massages = Session::get('success'))
                            <div class="col-md-4 alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white text-xs"><strong>{{ $massages }}</strong></span>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- style="border-radius: 5%;border-color:#7b5e50 !important;border-style:outset" --}}
                        <div class="row col-md-12" style="justify-content: center">
                            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="col-md-12 mb-" style="text-align: -webkit-center;">
                                    <img src="/images/logo3.png" class="p-4 w-80" alt="">
                                </div>
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start text-dark">
                                        <h4 class="font-weight-bolder text-dark">Masuk</h4>
                                        <p class="mb-0">Silahkan Masukkan Email dan Password!</p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="email" class="form-control form-control-lg"
                                                    placeholder="Email" aria-label="Email"
                                                    @error('email') is-invalid @enderror name="email"
                                                    value="{{ old('email') }}" required
                                                    autocomplete="email"style="border-color:#7b5e50 !important;border-style:outset"
                                                    autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="password" class="form-control form-control-lg"
                                                    placeholder="Password" aria-label="Password"
                                                    @error('password') is-invalid @enderror name="password" required
                                                    autocomplete="current-password"
                                                    style="border-color:#7b5e50 !important;border-style:outset">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div> --}}
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg bg-brown text-white btn-lg w-100 mt-4 mb-0">Masuk</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center" style="text-align-last: right; margin-right:1%;bottom: 20px;right: 20px;">
                <a href="https://forms.gle/68FDeDYfL6TTkkrQ6" class="btn bg-brown text-white text-lg"><i class="fa-regular fa-comment "></i> Feedback</a>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
