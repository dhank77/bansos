@extends('panel.layouts.app')

@section('title')
    Profil
@endsection

@section('content')
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span>Saber</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Saber Hoax
            </h2>
            <small>Saber Hoax Sulsel</small>
        </div>
    </div>
</div>

<div class="content animate-panel">

        <div id="linkvideoyoutube" class="row">
            <div class="col-lg-12 text-center m-t-md">
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="row">
                        
                            <div align="right" class="col-md-10">
                                <div class="form-group"><label class="col-sm-2 control-label">Link Video :</label>
                                    <div class="col-sm-10">
                                        <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                                        <input type="text" id="link" value="{{ $link }}" name="link" class="form-control" disabled>
                                    </div></form>
                                </div>
                            </div>
                            <div align="left" class="col-md-2">
                                <button onclick="bukadisabled()" class="btn btn-default"> <i class="fa fa-pencil" ></i> </button>
                                <button onclick="send()" class="btn btn-success">Update</button>
                                <i id="linkvideoyoutube_berhasil" style="display: none; color: green;" class="fa fa-check" ></i>
                            </div>    

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <div style="text-align: right"><small><strong>Terakhir diperbarui:</strong> {{ \Carbon\Carbon::parse($tgl)->format('d F Y, H:i')}}</small></div>
                    <form action="{{ route('panel.text.video.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea class="form-control" id="editor" name="desc" rows="15" placeholder="Masukkan teks" style="height: 100px;" required>{{ $text }}</textarea>
                        <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 5px">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function send(){
        var p = document.getElementById("link").value;
        $.get("/panel/updatelink/"+p);
        $( "#link" ).load(window.location.href + " #link" );
        document.getElementById("link").disabled = true;
        $("#linkvideoyoutube_berhasil").show().fadeOut(5000);
    }

    function bukadisabled(){
        document.getElementById("link").disabled = false;
    }
    </script>

@endsection