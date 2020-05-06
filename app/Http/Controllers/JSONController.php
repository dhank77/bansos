<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use response;
use Illuminate\Support\Facades\View;
use GuzzleHttp\Psr7;
use PDF;

class JSONController extends Controller {

    function DataJSON($triwulan) {
        

        $data = DB::table('rekap')
                ->select('namaskpd','anggaranBelanjaTidakLangsung','anggaranBelanjaLangsung','totalAnggaran','realisasiBelanjaTidakLangsung','realisasiBelanjaLangsung','totalRealisasi','fisikRealisasi','sisaAnggaran')
                ->where('bulan', $triwulan)
                ->orderBy('namaskpd','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('namaskpd', function ($data)  {
                return $data->namaskpd;
            })
            ->editColumn('anggaranbelanjatidaklangsung', function ($data)  {
                return $data->anggaranBelanjaTidakLangsung;
            })
            ->editColumn('anggaranbelanjalangsung', function ($data)  {
                return $data->anggaranBelanjaLangsung;
            })
            ->editColumn('totalanggaran', function ($data)  {
                return $data->totalAnggaran;
            })
            ->editColumn('realisasibelanjatidaklangsung', function ($data)  {
                return $data->realisasiBelanjaTidakLangsung;
            })
            ->editColumn('realisasibelanjalangsung', function ($data)  {
                return $data->realisasiBelanjaLangsung;
            })
            ->editColumn('totalrealisasi', function ($data)  {
                return $data->totalRealisasi;
            })
            ->editColumn('fisikrealisasi', function ($data)  {
                return $data->fisikRealisasi;
            })
            ->editColumn('sisaanggaran', function ($data)  {
                return $data->sisaAnggaran;
            })
            ->escapeColumns([])
            ->make(true);
    }

    function DataJSONskpd($triwulan) {
        $data = DB::table('rekap')
                ->select('id','namaskpd','anggaranBelanjaTidakLangsung','anggaranBelanjaLangsung','totalAnggaran','realisasiBelanjaTidakLangsung','realisasiBelanjaLangsung','totalRealisasi','fisikRealisasi','sisaAnggaran')
                ->where('kodeskpd',Auth::user()->kd_skpd)
                ->where('bulan', $triwulan)
                ->orderBy('namaskpd','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('namaskpd', function ($data)  {
                return $data->namaskpd;
            })
            ->editColumn('anggaranbelanjatidaklangsung', function ($data)  {
                return $data->anggaranBelanjaTidakLangsung;
            })
            ->editColumn('anggaranbelanjalangsung', function ($data)  {
                return $data->anggaranBelanjaLangsung;
            })
            ->editColumn('totalanggaran', function ($data)  {
                return $data->totalAnggaran;
            })
            ->editColumn('realisasibelanjatidaklangsung', function ($data)  {
                return $data->realisasiBelanjaTidakLangsung;
            })
            ->editColumn('realisasibelanjalangsung', function ($data)  {
                return $data->realisasiBelanjaLangsung;
            })
            ->editColumn('totalrealisasi', function ($data)  {
                return $data->totalRealisasi;
            })
            ->editColumn('fisikrealisasi', function ($data)  {
                return $data->fisikRealisasi;
            })
            ->editColumn('sisaanggaran', function ($data)  {
                return $data->sisaAnggaran;
            })
            ->editColumn('aksi', function ($data)  {
                return '    <div class="tooltip-demo">
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot, &quot;'.$data->fisikRealisasi.'&quot;)"><i class="fa fa-pencil"></i></button>
                            </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function IndexLaporan() {
        return view('panel.pagelaporan');
    }

    public function cetakLaporan($tahun, $triwulan){
        $data = DB::table('rekap')
        ->select('namaskpd','anggaranBelanjaTidakLangsung','anggaranBelanjaLangsung','totalAnggaran','realisasiBelanjaTidakLangsung','realisasiBelanjaTidakLangsungPersen','realisasiBelanjaLangsung','realisasiBelanjaLangsungPersen','totalRealisasi','totalRealisasiPersen','sisaAnggaran','fisikRealisasi')
        ->where('tahun',$tahun)
        ->where('bulan',$triwulan)
        ->orderBy('namaskpd','asc')
        ->get();

        if ($triwulan == '1'){
            $namabulan = 'JANUARI';
        } else if ($triwulan == '2') {
            $namabulan = 'FEBRUARY';
        } else if ($triwulan == '3') {
            $namabulan = 'MARET';
        } else if ($triwulan == '4') {
            $namabulan = 'APRIL';
        } else if ($triwulan == '5') {
            $namabulan = 'MEI';
        } else if ($triwulan == '6') {
            $namabulan = 'JUNI';
        } else if ($triwulan == '7') {
            $namabulan = 'JULI';
        } else if ($triwulan == '8') {
            $namabulan = 'AGUSTUS';
        } else if ($triwulan == '9') {
            $namabulan = 'SEPTEMBER';
        } else if ($triwulan == '10') {
            $namabulan = 'OKTOBER';
        } else if ($triwulan == '11') {
            $namabulan = 'NOVEMBER';
        } else if ($triwulan == '12') {
            $namabulan = 'DESEMBER';
        }
 
        
        $pdf = PDF::loadview('panel.laporansiarfak',['data' => $data, 'tahun' => $tahun, 'bulan' => $namabulan])->setPaper('legal', 'landscape');
        return $pdf->save('filelaporan/' . $tahun . $triwulan . '.pdf');
        // return $pdf->stream();
    }

    function FisikRealisasiEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'FisikRealisasi'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('rekap')
                    ->where('id',$request->id)
                    ->update([
                        'fisikRealisasi'        => $request->FisikRealisasi,
                    ]);
            return null;
        }
    }

}