
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Login | Satya Lancana</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/fontawesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/metisMenu/dist/metisMenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/animate.css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/bootstrap/dist/css/bootstrap.css') }}" />

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('assets_panel/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/fonts/pe-icon-7-stroke/css/helper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/styles/style.css') }}">

</head>
<body class="blank" style="background-image: url(/assets_panel/images/bg.png);">

<!-- Simple splash screen-->
<div class="splash">
    <div class="splash-title">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        &copy;2020 Bantuan Sosial
    </div>
</div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line"></div>

<div class="back-link">
    <a href="{{ route('index') }}" style="display: none;" class="btn btn-primary">Kembali ke halaman depan</a>
</div>
@if (Session::has('alertGagal'))
<script type="text/javascript">
    window.onload = function () {
        alertGagals("{{ Session::get('alertGagal') }}");
    }
</script>
@endif

<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>SELAMAT DATANG</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
                            <input type="text" title="Please enter you username" required="" value="{{ old('email') }}" name="email" autofocus="autofocus" id="username" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">
                        </div>
                        <button class="btn btn-success btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            &copy;2020 Bantuan Sosial
        </div>
    </div>
</div>


<!-- Vendor scripts -->
<script src="{{ asset('assets_panel/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/metisMenu/dist/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/sparkline/index.js') }}"></script>

<!-- App scripts -->
<script src="{{ asset('assets_panel/scripts/homer.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script>
function alertGagals($txt) {
    swal.fire({
        title: 'Oops...',
        html: $txt,
        type: 'error',
        showCancelButton: false,
        showConfirmButton: true
    })
}
</script>

</body>
</html>