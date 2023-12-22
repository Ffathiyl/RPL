<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/AstraTech.png') }}" alt="">
                <!-- <span class="d-none d-lg-block">AstraTech</span> -->
            </a>
        </div><!-- End Logo -->
    </header><!-- End Header -->

    <body style="background-image: url('{{ asset('assets/img/IMG_Background.jpg') }}'); display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-4 offset-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Login</h5>

                            <!-- Display success and error messages if any -->
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{ route('logins.auth') }}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputName" class="form-label">Username <span style="color:red">*
                                            @error('Username') {{ $message }} @enderror</span></label>
                                    <input type="text" class="form-control" id="Username" name="Username"
                                        value="{{ Session::get('username') }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword" class="form-label">Password <span style="color:red">*
                                            @error('Password') {{ $message }} @enderror</span></label>
                                    <input type="password" class="form-control" id="Password" name="Password">
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form><!-- Vertical Form -->
                            <br>
                            <!-- Include link to login as Pengurus -->
                            <span>Belum Memiliki Akun? <a href="{{ route('auth.register') }}">Klik
                                    disini.</a></span>

                        </div>
                    </div>
                </div>
                <!-- Tambahkan div untuk elemen di sebelah kanan -->
                <div class="col-lg-6">
                    <!-- Isi dengan elemen yang diinginkan -->
                </div>
            </div>
        </div>

        <!-- ======= Footer ======= -->
        <div class="mt-5" style="background-color: white; width: 100%; position: fixed; left: 0; bottom: 0;">
            <div class="container-fluid">
                <footer class="d-flex flex-wrap pt-3 pb-3 border-top">
                    Copyright &copy; @php echo date('Y') @endphp - POMA
                </footer>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @if (Session::has('error'))
    <script>
        console.log('Error');
        Swal.fire({
            title: 'Pesan',
            text: '{{ Session::get('error') }}',
            icon: 'error'
        });
    </script>
    @endif

    @if (Session::has('successLogout'))
    <script>
        console.log('success');
        Swal.fire({
            title: 'Pesan',
            text: '{{ Session::get('successLogout') }}',
            icon: 'success'
        });
    </script>
    @endif

</html>