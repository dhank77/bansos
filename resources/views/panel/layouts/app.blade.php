<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Page title -->
    <title>@yield('title')</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="icon" sizes="16x16" type="image/png" href="{{ asset('assets_panel/images/logo.png') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/fontawesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/metisMenu/dist/metisMenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/animate.css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/vendor/bootstrap/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_panel/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_panel/vendor/fancy-file-uploader/fancy_fileupload.css') }}" media="all" />

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('assets_panel/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/fonts/pe-icon-7-stroke/css/helper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_panel/styles/style.css') }}">

    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />

    <script src="{{ asset('assets_panel/vendor/jquery/dist/jquery.min.js') }}"></script>

    <style>
    .loader {
      margin-left: auto;
      margin-right: auto;
      border: 10px solid #f3f3f3;
      border-radius: 50%;
      border-top: 10px solid #3498db;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>

</head>
<body class="fixed-navbar fixed-sidebar">

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
        &copy;Bansos
    </div>
</div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Header -->
<div id="header">
    @if (Session::has('alertSuccess'))
    <script type="text/javascript">
        window.onload = function () {
            alertSuccess("{{ Session::get('alertSuccess') }}");
        }
    </script>
    @endif
    @if (Session::has('alertGagal'))
    <script type="text/javascript">
        window.onload = function () {
            alertGagal2("{{ Session::get('alertGagal') }}");
        }
    </script>
    @endif
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span>HOME</span>
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary">HOMER APP</span>
        </div>
        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
            <div class="collapse mobile-navbar" id="mobile-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="" href="login.html">Login</a>
                    </li>
                    <li>
                        <a class="" href="login.html">Logout</a>
                    </li>
                    <li>
                        <a class="" href="profile.html">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="dropdown tooltip-demo">
                    <a href="{{ route('panel.akun') }}" data-toggle="tooltip" data-placement="left" title="Akun">
                        <i class="pe-7s-user"></i>
                    </a>
                </li>
                <li class="dropdown tooltip-demo">
                    <a href="{{ route('panel.logout') }}" data-toggle="tooltip" data-placement="left" title="Keluar">
                        <i class="pe-7s-power"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <img src="{{ asset('assets_panel/images/logo.png') }}" width="80px" class="img-circle m-b" alt="logo">

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase">{{ Auth::user()->name }}</span>

                <div class="dropdown">
                    <small class="text-muted">{{ Session::get('role') }}</small>
                </div>

            </div>
        </div>

        <ul class="nav" id="side-menu">
            <li class="{{ Request::is('panel') ? 'active' : '' }}">
                <a href="{{ route('panel.dashboard') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Dashboard</span> </a>
            </li>
            <li class="{{ Request::is('panel/data/daerah*') ? 'active' : '' }}">
                <a href="{{ route('panel.daerah') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Data Daerah</span> </a>
            </li>
            <li class="{{ Request::is('panel/data/bansos*') ? 'active' : '' }}">
                <a href="{{ route('panel.bansos') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Data Bansos</span> </a>
            </li>
            @role('superadmin')
            <!-- <li class="{{ Request::is('panel/pegawai*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Master Data</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/pegawai') ? 'active' : '' }}">
                        <a href="{{ route('panel.pegawai') }}"> <span class="nav-label"> <i class="fa fa-users" ></i> Pegawai</span> </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('panel/penghargaan/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Penghargaan</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/penghargaan/periode') ? 'active' : '' }}">
                        <a href="{{ route('panel.periode') }}"> <span class="nav-label"> <i class="fa fa-calendar" ></i> Periode</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/penghargaan/usulan-pegawai') ? 'active' : '' }}">
                        <a href="{{ route('panel.usulan.pegawai') }}"> <span class="nav-label"> <i class="fa fa-user-plus" ></i> Usulan Pegawai</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/penghargaan/penerima') ? 'active' : '' }}">
                        <a href="{{ route('panel.penerima.penghargaan') }}"> <span class="nav-label"> <i class="fa fa-user" ></i> Penerima</span> </a>
                    </li>
                </ul>
            </li>
            
            <li class="{{ Request::is('panel/laporan/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-book" ></i> Laporan</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/laporan/hal-laporan') ? 'active' : '' }}">
                        <a href="{{ route('panel.pagelaporan') }}"> <span class="nav-label">Laporan Per SKPD</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/laporan/hal-laporan-semua') ? 'active' : '' }}">
                        <a href="{{ route('panel.pagelaporanall') }}"> <span class="nav-label">Laporan Semua</span> </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('panel/konfigurasi/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Konfigurasi</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/konfigurasi/masters/users') ? 'active' : '' }}">
                        <a href="{{ route('panel.users') }}"><span class="nav-label"><i class="fa fa-home" ></i> Users</span></a>
                    </li> 
                    <li class="{{ Request::is('panel/konfigurasi/persyaratan') ? 'active' : '' }}">
                        <a href="{{ route('panel.persyaratan') }}"><span class="nav-label"><i class="fa fa-home" ></i> Persyaratan</span></a>
                    </li> 
                </ul>
            </li> -->
            @endrole

            @role('admin')
            <li class="{{ Request::is('panel/pegawai*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Master Data</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/pegawai') ? 'active' : '' }}">
                        <a href="{{ route('panel.pegawai') }}"> <span class="nav-label"> <i class="fa fa-users" ></i> Pegawai</span> </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('panel/penghargaan/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Penghargaan</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/penghargaan/usulan-pegawai') ? 'active' : '' }}">
                        <a href="{{ route('panel.usulan.pegawai') }}"> <span class="nav-label"> <i class="fa fa-user-plus" ></i> Usulan Pegawai</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/penghargaan/status') ? 'active' : '' }}">
                        <a href="{{ route('panel.status') }}"> <span class="nav-label"> <i class="fa fa-user-plus" ></i> Status</span> </a>
                    </li>
                </ul>
            </li>
            @endrole

            @role('verifikator')
            <li class="{{ Request::is('panel/penghargaan/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-gear" ></i> Penghargaan</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/penghargaan/periode') ? 'active' : '' }}">
                        <a href="{{ route('panel.periode') }}"> <span class="nav-label"> <i class="fa fa-calendar" ></i> Periode</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/penghargaan/usulan-pegawai') ? 'active' : '' }}">
                        <a href="{{ route('panel.usulan.pegawai') }}"> <span class="nav-label"> <i class="fa fa-user-plus" ></i> Usulan Pegawai</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/penghargaan/penerima') ? 'active' : '' }}">
                        <a href="{{ route('panel.penerima.penghargaan') }}"> <span class="nav-label"> <i class="fa fa-user" ></i> Penerima</span> </a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('panel/laporan/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-book" ></i> Laporan</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/laporan/hal-laporan') ? 'active' : '' }}">
                        <a href="{{ route('panel.pagelaporan') }}"> <span class="nav-label">Laporan Per SKPD</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/laporan/hal-laporan-semua') ? 'active' : '' }}">
                        <a href="{{ route('panel.pagelaporanall') }}"> <span class="nav-label">Laporan Semua</span> </a>
                    </li>
                </ul>
            </li>
            @endrole









            @role('superadmin')
            <!-- <li class="{{ Request::is('panel/master/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-home" ></i> Master</span><span class="fa arrow"></span> </a>
                
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/master/belanja*') ? 'active' : '' }}">
                        <a href="{{ route('panel.master.belanja') }}"> <span class="nav-label">Jenis Belanja</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/master/kodefikasi*') ? 'active' : '' }}">
                        <a href="{{ route('panel.master.kodefikasi') }}"> <span class="nav-label">Kodefikasi Masalah</span> </a>
                    </li>
                </ul>
            </li>-->
<!--             
            <li class="{{ Request::is('panel/masters/users') ? 'active' : '' }}">
                <a href="{{ route('panel.users') }}"><span class="nav-label"><i class="fa fa-home" ></i> Users</span></a>
            </li> 
            <li class="{{ Request::is('panel/hal-laporan') ? 'active' : '' }}">
                <a href="{{ route('panel.pagelaporan') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Laporan</span> </a>
            </li> -->
            @endrole

            @role('admin')
            <!-- <li class="{{ Request::is('panel/masters/users/skpd*') ? 'active' : '' }}">
                <a href="{{ route('panel.usersSkpd') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Users</span> </a>
            </li> -->
            <!-- <li class="{{ Request::is('panel/hal-laporan') ? 'active' : '' }}">
                <a href="{{ route('panel.pagelaporan') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Laporan</span> </a>
            </li> -->
            @endrole

            @role('skpd')

            <li class="{{ Request::is('panel/master/*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label"><i class="fa fa-home" ></i> Master</span><span class="fa arrow"></span> </a>
                
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/ms_bidang') ? 'active' : '' }}">
                        <a href="{{ route('panel.ms_bidang') }}"> <span class="nav-label"></i> Master Bidang</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/ms_subbidang') ? 'active' : '' }}">
                        <a href="{{ route('panel.ms_subbidang') }}"> <span class="nav-label"> </i> Master Sub Bidang</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/ms_program') ? 'active' : '' }}">
                        <a href="{{ route('panel.ms_program') }}"> <span class="nav-label"> </i> Master Program</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/ms_kegiatan') ? 'active' : '' }}">
                        <a href="{{ route('panel.ms_kegiatan') }}"> <span class="nav-label"> </i> Master Kegiatan</span> </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('panel/program') ? 'active' : '' }}">
                <a href="{{ route('panel.program') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Data Dak</span> </a>
            </li>
            <li class="{{ Request::is('panel/hal-laporan') ? 'active' : '' }}">
                <a href="{{ route('panel.pagelaporan') }}"> <span class="nav-label"> <i class="fa fa-home" ></i> Laporan</span> </a>
            </li>
            @endrole



            <!-- <li class="{{ Request::is('panel/profil*') ? 'active' : '' }}">
                <a href="{{ route('panel.profil') }}"> <span class="nav-label"> <i class="fa fa-file-text-o" ></i> Saber Hoax </span></a>
            </li>
            <li class="{{ Request::is('panel/post*') ? 'active' : '' }}">
                <a href="{{ route('panel.post') }}"> <span class="nav-label"> <i class="fa fa-book" ></i> Infografik</span> </a>
            </li>
            <li class="{{ Request::is('panel/lapor*') ? 'active' : '' }}">
                <a href="{{ route('panel.lapor') }}"> <span class="nav-label"> <i class="fa fa-newspaper-o" ></i> Laporan Hoax</span> </a>
            </li>
            <li class="{{ Request::is('panel/berita*') ? 'active' : '' }}">
                <a href="{{ route('panel.berita') }}"> <span class="nav-label"> <i class="fa fa-newspaper-o" ></i> Verifikasi Hoax </span></a>
            </li> -->

            @role('admin')
            
            @endrole
            @role('admin|moderator')
            <!-- <li class="{{ Request::is('panel/post*') ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Posts</span><span class="fa arrow"></span> </a>
                
                <ul class="nav nav-second-level">
                    <li class="{{ Request::is('panel/agenda*') ? 'active' : '' }}">
                        <a href="{{ route('panel.post') }}"> <span class="nav-label">Produk Hukum</span> </a>
                    </li>
                    <li class="{{ Request::is('panel/agenda*') ? 'active' : '' }}">
                        <a href="{{ route('panel.berita') }}"> <span class="nav-label">Berita </span></a>
                    </li>
                    <li class="{{ Request::is('panel/agenda*') ? 'active' : '' }}">
                        <a href="{{ route('panel.agenda') }}"> <span class="nav-label">Profil </span></a>
                    </li>
                </ul>
        
            </li> -->
            
            @endrole
        </ul>
    </div>
</aside>
<!-- Main Wrapper -->
<div id="wrapper" style="background-image: url(/assets_panel/images/bg.png);">

@yield('content')

<!-- Footer-->
    <footer class="footer">
        <span class="pull-right">
             
        </span>
        &copy;2020 Bansos
    </footer>

</div>
<!-- Vendor scripts -->

<script src="{{ asset('assets_panel/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/jquery-flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/jquery-flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/jquery-flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/flot.curvedlines/curvedLines.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/jquery.flot.spline/index.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/metisMenu/dist/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/sparkline/index.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/sweetalert/sweetalert2885.all.min.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/sweetalert/custom.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets_panel/vendor/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>

<!-- App scripts -->
<script src="{{ asset('assets_panel/scripts/homer.js') }}"></script>
<script src="{{ asset('assets_panel/scripts/charts.js') }}"></script>
<script>
    $(function () {
        var data1 = [ [0, 55], [1, 48], [2, 40], [3, 36], [4, 40], [5, 60], [6, 50], [7, 51] ];
        var data2 = [ [0, 56], [1, 49], [2, 41], [3, 38], [4, 46], [5, 67], [6, 57], [7, 59] ];

        var chartUsersOptions = {
            series: {
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
            },
            grid: {
                tickColor: "#f0f0f0",
                borderWidth: 1,
                borderColor: 'f0f0f0',
                color: '#6a6c6f'
            },
            colors: [ "#62cb31", "#efefef"],
        };

        $.plot($("#flot-line-chart"), [data1, data2], chartUsersOptions);

        /**
         * Flot charts 2 data and options
         */
        var chartIncomeData = [
            {
                label: "line",
                data: [ [1, 10], [2, 26], [3, 16], [4, 36], [5, 32], [6, 51] ]
            }
        ];

        var chartIncomeOptions = {
            series: {
                lines: {
                    show: true,
                    lineWidth: 0,
                    fill: true,
                    fillColor: "#64cc34"

                }
            },
            colors: ["#62cb31"],
            grid: {
                show: false
            },
            legend: {
                show: false
            }
        };

        $.plot($("#flot-income-chart"), chartIncomeData, chartIncomeOptions);
    });
</script>
<script>
    var editor_config = {
        path_absolute : "/",
        selector: "#editor",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }
    
        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(editor_config);

    var descEdit = {
        path_absolute : "/",
        selector: "#descEdit",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }
    
        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(descEdit);
</script>
</body>
</html>