<?php

namespace App\Http\Controllers;

use App\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use GuzzleHttp\Psr7;
use Yajra\DataTables\Facades\DataTables;

class IndexController extends Controller
{
    function index(Request $request)
    {
        if (Auth::guest()) {
            $data = DB::table('ms_kab')
                ->select('kd_kab', 'nama_kab')
                ->get();
            $data2 = DB::table('ms_kab')
                ->selectRaw("ms_kab.nama_kab,
                    (SELECT COUNT(ID) FROM t_penerima WHERE KD_KAB = ms_kab.kd_kab) as jumlah
                    ")
                ->orderby('jumlah', 'desc')
                ->get();
            $json = file_get_contents(url('sulsel.json'));
            $decodes = json_decode($json, true);
            $data_maps = [];
            foreach ($decodes['features'] as &$decode) {
                $jumlah = Penerima::where('KD_KAB', $decode['properties']['ID_0'])->count();
                if ($jumlah) {
                    $decode['properties']['jumlah'] = $jumlah;
                }
                array_push($data_maps, $decode);
            }
            $maps = json_encode($data_maps);
            return view('index', compact('data', 'data2', 'maps'));
        } else if (Auth::check()) {
            return redirect('/panel');
        }
    }

    public function route()
    {
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
    }


    public function donasi()
    {
        $data = DB::table('ms_kab')
            ->select('kd_kab', 'nama_kab')
            ->get();
        return view('donasi', compact('data'));
    }

    public function donasiJSON()
    {
        function BansosJSON()
        {
            $data = DB::table('t_pemberi_bantuan')
                ->select('id', 'pemberi_bantuan', 'jenis_bantuan', 'jumlah', 'total', 'tanggal_masuk', 'keterangan')
                ->orderBy('id', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('no', function ($data) {
                    return '    <p>' . $data->IDBDT . '</p>';
                })
                ->editColumn('nama', function ($data) {
                    return '    <p>' . $data->NAMA . '</p>';
                })
                ->editColumn('KABUPATEN', function ($data) {
                    return '    <p>' . $data->KABUPATEN . '</p>';
                })
                ->editColumn('ALAMAT', function ($data) {
                    return '    <p>' . $data->ALAMAT . '</p>';
                })
                ->editColumn('JUMLAH_ART', function ($data) {
                    return '    <p>' . $data->JUMLAH_ART . '</p>';
                })
                ->editColumn('PERSENTIL', function ($data) {
                    return '    <p>' . $data->PERSENTIL . '</p>';
                })
                ->editColumn('aksi', function ($data) {
                    return '
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;' . $data->ID . '&quot;,&quot;' . $data->NAMA . '&quot;)"><i class="fa fa-pencil"></i></button> | 
                    <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;' . $data->ID . '&quot;)"><i class="fa fa-trash"></i></button>';
                })
                ->escapeColumns([])
                ->make(true);
        }
    }
}
