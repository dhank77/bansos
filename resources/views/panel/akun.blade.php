@extends('panel.layouts.app')

@section('title')
    Settings
@endsection

@section('content')
<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>

            <div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
                    <li class="active">
                        <span>Akun</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                AKUN
            </h2>
            <small>Pengaturan akun</small>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    Ganti Password
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.akun.edit-password') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Password sekarang</label>
                            <div class="col-sm-10">
                                <input type="password" name="passwordSekarang" class="form-control">
                                @if ($errors->has('passwordSekarang'))
                                    <span class="help-block small">{{ $errors->first('passwordSekarang') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Password baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="passwordBaru" class="form-control">
                                @if ($errors->has('passwordBaru'))
                                    <span class="help-block small">{{ $errors->first('passwordBaru') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Ulangi password baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="ulangiPasswordBaru" class="form-control">
                                @if ($errors->has('ulangiPasswordBaru'))
                                    <span class="help-block small">{{ $errors->first('ulangiPasswordBaru') }}</span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-success pull-right" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection