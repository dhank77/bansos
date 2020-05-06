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
                        <span>Settings</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                SETTINGS
            </h2>
            <small>Pengaturan website {{ $settings->namaOpd }}</small>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.settings.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Tema</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="styleName" id="styleName">
                                    @foreach ($theme as $rTheme) 
                                        <option value="{{ $rTheme->styleName }}" @if ($setting->theme == $rTheme->styleName) selected @endif>{{ $rTheme->displayName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" class="form-control" accept="image/*" @role('moderator|admin') disabled @endrole>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10"><input type="text" name="namaOpd" class="form-control" value="{{ $setting->namaOpd }}" @role('moderator|admin') readonly @endrole @role('superadmin') required @endrole></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Versi</label>
                            <div class="col-sm-10"><input type="text" class="form-control" value={{ config('app.versi') }} disabled></div>
                        </div>
                        <button class="btn btn-success pull-right" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection