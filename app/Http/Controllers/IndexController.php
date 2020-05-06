<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use GuzzleHttp\Psr7;

class IndexController extends Controller {
    function index(Request $request) {
        if(Auth::guest()){
            $data = DB::table('ms_kab')
                ->select('kd_kab','nama_kab')
                ->get();
            $data2 = DB::table('ms_kab')
                ->selectRaw("ms_kab.nama_kab,
                    (SELECT COUNT(ID) FROM t_penerima WHERE KD_KAB = ms_kab.kd_kab) as jumlah
                    ")
                ->orderby('jumlah','desc')
                ->get();
            return view('index',[ 'data' => $data, 'data2' => $data2]);
        }else if(Auth::check()){
            return redirect('/panel');
        }
    }

    public function route(){
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
    }
}
