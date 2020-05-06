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

class ApiController extends Controller {
    function index(Request $request) {
        if(Auth::guest()){
            return view('auth.login');
        }else if(Auth::check()){
            return redirect('/panel');
        }
    }

    public function route(){
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
    }

    function unker() {
        $original = Psr7\stream_for(fopen('https://smartofficev3.sulselprov.go.id/api/data/unker?page=3&limit=100&show_upt=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['message'];

        foreach ($bData as $xData) {
            $ada = DB::table('mt_unit_kerja')->where('kdunker', $xData['id_unker'])->count();
            if ($ada > 0) {
                DB::table('mt_unit_kerja')
                ->where('kdunker', $xData['id_unker'])
                ->update([
                    'unker'    => $xData['unker'],
                ]);
            } else {
                DB::table('mt_unit_kerja')
                ->insert([
                    'kdunker'  => $xData['id_unker'],
                    'unker'     => $xData['unker'],
                ]);
            }
        }
    }

    function pegawai($awal, $akhir) {

        for ($x = $awal; $x <= $akhir; $x++) {

            $original = Psr7\stream_for(fopen('https://smartofficev3.sulselprov.go.id/api/data/pegawai?page='.$x.'&limit=100', 'r'));
            $stream = new Psr7\CachingStream($original);
            $Data = json_decode($stream, true);
            $bData = $Data['message'];

            foreach ($bData as $xData) {
                DB::table('mt_pegawai')
                    ->where('nip', $xData['nip'])
                    ->update([
                        'id_unker'    => $xData['id_unker'],
                    ]);
            }

        }


    }

    function total() {
        $data = DB::table('mt_pegawai')
                ->where('id_unker', null)
                ->count();
        return $data;
    }


    function apianggaran() {
        $original = Psr7\stream_for(fopen('https://ebudgeting.sulselprov.go.id/service/gateArfak.php?laporan=anggaran&skpd=&bulan=2', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {
            $ada = DB::table('anggaran')
                    ->where('idpskpd', $xData['idpskpd'])
                    ->where('idp_program', $xData['idp_program'])
                    ->where('idp_kegiatan', $xData['idp_kegiatan'])
                    ->where('kodeUrusanProgram', $xData['kodeUrusanProgram'])
                    ->where('kodeUrusanPelaksana', $xData['kodeUrusanPelaksana'])
                    ->where('kodeSKPD', $xData['kodeSKPD'])
                    ->where('kodeProgram', $xData['kodeProgram'])
                    ->where('kodeKegiatan', $xData['kodeKegiatan'])
                    ->where('kodeFungsi', $xData['kodeFungsi'])
                    ->where('kodeAkunUtama', $xData['kodeAkunUtama'])
                    ->where('kodeAkunKelompok', $xData['kodeAkunKelompok'])
                    ->where('kodeAkunJenis', $xData['kodeAkunJenis'])
                    ->where('kodeAkunObjek', $xData['kodeAkunObjek'])
                    ->where('kodeAkunRincian', $xData['kodeAkunRincian'])
                    ->where('kodeAkunSub', $xData['kodeAkunSub'])
                    ->where('tahun', date('Y'))
                    ->count();

            if ($ada > 0) {
                DB::table('anggaran')
                    ->where('idpskpd', $xData['idpskpd'])
                    ->where('idp_program', $xData['idp_program'])
                    ->where('idp_kegiatan', $xData['idp_kegiatan'])
                    ->where('kodeUrusanProgram', $xData['kodeUrusanProgram'])
                    ->where('kodeUrusanPelaksana', $xData['kodeUrusanPelaksana'])
                    ->where('kodeSKPD', $xData['kodeSKPD'])
                    ->where('kodeProgram', $xData['kodeProgram'])
                    ->where('kodeKegiatan', $xData['kodeKegiatan'])
                    ->where('kodeFungsi', $xData['kodeFungsi'])
                    ->where('kodeAkunUtama', $xData['kodeAkunUtama'])
                    ->where('kodeAkunKelompok', $xData['kodeAkunKelompok'])
                    ->where('kodeAkunJenis', $xData['kodeAkunJenis'])
                    ->where('kodeAkunObjek', $xData['kodeAkunObjek'])
                    ->where('kodeAkunRincian', $xData['kodeAkunRincian'])
                    ->where('kodeAkunSub', $xData['kodeAkunSub'])
                    ->where('tahun', date('Y'))
                ->update([
                    'namaUrusanProgram'    => $xData['namaUrusanProgram'],
                    'namaUrusanPelaksana'    => $xData['namaUrusanPelaksana'],
                    'namaSKPD'    => $xData['namaSKPD'],
                    'namaProgram'    => $xData['namaProgram'],
                    'namaKegiatan'    => $xData['namaKegiatan'],
                    'namaFungsi'    => $xData['namaFungsi'],
                    'namaAkunUtama'    => $xData['namaAkunUtama'],
                    'namaAkunKelompok'    => $xData['namaAkunKelompok'],
                    'namaAkunJenis'    => $xData['namaAkunJenis'],
                    'namaAkunObjek'    => $xData['namaAkunObjek'],
                    'namaAkunRincian'    => $xData['namaAkunRincian'],
                    'namaAkunSub'    => $xData['namaAkunSub'],
                    'nilaiAnggaran'    => $xData['nilaiAnggaran'],
                ]);
            } else {
                DB::table('anggaran')
                ->insert([
                    'idpskpd'     => $xData['idpskpd'],
                    'idp_program'    => $xData['idp_program'],
                    'idp_kegiatan'    => $xData['idp_kegiatan'],
                    'kodeUrusanProgram'    => $xData['kodeUrusanProgram'],
                    'namaUrusanProgram'    => $xData['namaUrusanProgram'],
                    'kodeUrusanPelaksana'    => $xData['kodeUrusanPelaksana'],
                    'namaUrusanPelaksana'    => $xData['namaUrusanPelaksana'],
                    'kodeSKPD'    => $xData['kodeSKPD'],
                    'namaSKPD'    => $xData['namaSKPD'],
                    'kodeProgram'    => $xData['kodeProgram'],
                    'namaProgram'    => $xData['namaProgram'],
                    'kodeKegiatan'    => $xData['kodeKegiatan'],
                    'namaKegiatan'    => $xData['namaKegiatan'],
                    'kodeFungsi'    => $xData['kodeFungsi'],
                    'namaFungsi'    => $xData['namaFungsi'],
                    'kodeAkunUtama'    => $xData['kodeAkunUtama'],
                    'namaAkunUtama'    => $xData['namaAkunUtama'],
                    'kodeAkunKelompok'    => $xData['kodeAkunKelompok'],
                    'namaAkunKelompok'    => $xData['namaAkunKelompok'],
                    'kodeAkunJenis'    => $xData['kodeAkunJenis'],
                    'namaAkunJenis'    => $xData['namaAkunJenis'],
                    'kodeAkunObjek'    => $xData['kodeAkunObjek'],
                    'namaAkunObjek'    => $xData['namaAkunObjek'],
                    'kodeAkunRincian'    => $xData['kodeAkunRincian'],
                    'namaAkunRincian'    => $xData['namaAkunRincian'],
                    'kodeAkunSub'    => $xData['kodeAkunSub'],
                    'namaAkunSub'    => $xData['namaAkunSub'],
                    'nilaiAnggaran'    => $xData['nilaiAnggaran'],
                    'tahun' => date('Y'),
                ]);
            }
        }
    }


    function apirealisasi() {

        $bulan = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

        foreach ($bulan as $xbulan) {

            $original = Psr7\stream_for(fopen('https://ebudgeting.sulselprov.go.id/service/gateArfak.php?laporan=realisasi&skpd=&bulan='.$xbulan, 'r'));
                $stream = new Psr7\CachingStream($original);
                $Data = json_decode($stream, true);
                $bData = $Data['data'];
        
                foreach ($bData as $xData) {
                    $ada = DB::table('realisasi')
                            ->where('idpskpd', $xData['idpskpd'])
                            ->where('idp_program', $xData['idp_program'])
                            ->where('idp_kegiatan', $xData['idp_kegiatan'])
                            ->where('periode', $xData['periode'])
                            ->where('kodeUrusanProgram', $xData['kodeUrusanProgram'])
                            ->where('kodeUrusanPelaksana', $xData['kodeUrusanPelaksana'])
                            ->where('kodeSKPD', $xData['kodeSKPD'])
                            ->where('kodeProgram', $xData['kodeProgram'])
                            ->where('kodeKegiatan', $xData['kodeKegiatan'])
                            ->where('kodeFungsi', $xData['kodeFungsi'])
                            ->where('kodeAkunUtama', $xData['kodeAkunUtama'])
                            ->where('kodeAkunKelompok', $xData['kodeAkunKelompok'])
                            ->where('kodeAkunJenis', $xData['kodeAkunJenis'])
                            ->where('kodeAkunObjek', $xData['kodeAkunObjek'])
                            ->where('kodeAkunRincian', $xData['kodeAkunRincian'])
                            ->where('kodeAkunSub', $xData['kodeAkunSub'])
                            ->count();
        
                    if ($ada > 0) {
                        DB::table('realisasi')
                        ->where('idpskpd', $xData['idpskpd'])
                        ->where('idp_program', $xData['idp_program'])
                        ->where('idp_kegiatan', $xData['idp_kegiatan'])
                        ->where('periode', $xData['periode'])
                        ->where('kodeUrusanProgram', $xData['kodeUrusanProgram'])
                        ->where('kodeUrusanPelaksana', $xData['kodeUrusanPelaksana'])
                        ->where('kodeSKPD', $xData['kodeSKPD'])
                        ->where('kodeProgram', $xData['kodeProgram'])
                        ->where('kodeKegiatan', $xData['kodeKegiatan'])
                        ->where('kodeFungsi', $xData['kodeFungsi'])
                        ->where('kodeAkunUtama', $xData['kodeAkunUtama'])
                        ->where('kodeAkunKelompok', $xData['kodeAkunKelompok'])
                        ->where('kodeAkunJenis', $xData['kodeAkunJenis'])
                        ->where('kodeAkunObjek', $xData['kodeAkunObjek'])
                        ->where('kodeAkunRincian', $xData['kodeAkunRincian'])
                        ->where('kodeAkunSub', $xData['kodeAkunSub'])
                        ->update([
                            'namaUrusanProgram'    => $xData['namaUrusanProgram'],
                            'namaUrusanPelaksana'    => $xData['namaUrusanPelaksana'],
                            'namaSKPD'    => $xData['namaSKPD'],
                            'namaProgram'    => $xData['namaProgram'],
                            'namaKegiatan'    => $xData['namaKegiatan'],
                            'namaFungsi'    => $xData['namaFungsi'],
                            'namaAkunUtama'    => $xData['namaAkunUtama'],
                            'namaAkunKelompok'    => $xData['namaAkunKelompok'],
                            'namaAkunJenis'    => $xData['namaAkunJenis'],
                            'namaAkunObjek'    => $xData['namaAkunObjek'],
                            'namaAkunRincian'    => $xData['namaAkunRincian'],
                            'namaAkunSub'    => $xData['namaAkunSub'],
                            'nilaiRealisasi'    => $xData['nilaiRealisasi'],
                            'tahun' => date('Y'),
                        ]);
                    } else {
                        DB::table('realisasi')
                        ->insert([
                            'periode'     => $xData['periode'],
                            'idpskpd'     => $xData['idpskpd'],
                            'idp_program'    => $xData['idp_program'],
                            'idp_kegiatan'    => $xData['idp_kegiatan'],
                            'kodeUrusanProgram'    => $xData['kodeUrusanProgram'],
                            'namaUrusanProgram'    => $xData['namaUrusanProgram'],
                            'kodeUrusanPelaksana'    => $xData['kodeUrusanPelaksana'],
                            'namaUrusanPelaksana'    => $xData['namaUrusanPelaksana'],
                            'kodeSKPD'    => $xData['kodeSKPD'],
                            'namaSKPD'    => $xData['namaSKPD'],
                            'kodeProgram'    => $xData['kodeProgram'],
                            'namaProgram'    => $xData['namaProgram'],
                            'kodeKegiatan'    => $xData['kodeKegiatan'],
                            'namaKegiatan'    => $xData['namaKegiatan'],
                            'kodeFungsi'    => $xData['kodeFungsi'],
                            'namaFungsi'    => $xData['namaFungsi'],
                            'kodeAkunUtama'    => $xData['kodeAkunUtama'],
                            'namaAkunUtama'    => $xData['namaAkunUtama'],
                            'kodeAkunKelompok'    => $xData['kodeAkunKelompok'],
                            'namaAkunKelompok'    => $xData['namaAkunKelompok'],
                            'kodeAkunJenis'    => $xData['kodeAkunJenis'],
                            'namaAkunJenis'    => $xData['namaAkunJenis'],
                            'kodeAkunObjek'    => $xData['kodeAkunObjek'],
                            'namaAkunObjek'    => $xData['namaAkunObjek'],
                            'kodeAkunRincian'    => $xData['kodeAkunRincian'],
                            'namaAkunRincian'    => $xData['namaAkunRincian'],
                            'kodeAkunSub'    => $xData['kodeAkunSub'],
                            'namaAkunSub'    => $xData['namaAkunSub'],
                            'nilaiRealisasi'    => $xData['nilaiRealisasi'],
                            'tahun' => date('Y'),
                        ]);
                    }
                }

        }
    }

    function program(){
        $data = DB::table('anggaran')
            ->select('kodeProgram','namaProgram','kodeSKPD')
            ->get();
        foreach ($data as $xdata) {
            $ada = DB::table('program')
            ->where('kodeprogram', $xdata->kodeProgram)
            ->where('kodeskpd', $xdata->kodeSKPD)
            ->count();
            if ($ada > 0) {
                DB::table('program')
                    ->where('kodeprogram', $xdata->kodeProgram)
                    ->where('kodeskpd', $xdata->kodeSKPD)
                    ->update([  
                        'namaprogram' => $xdata->namaProgram,
                            ]);
            } else {
                DB::table('program')
                    ->insert([  
                        'kodeprogram' => $xdata->kodeProgram,
                        'namaprogram' => $xdata->namaProgram,
                        'kodeskpd'    => $xdata->kodeSKPD
                            ]);
            }
        }
    }


    function kegiatan(){
        $data = DB::table('anggaran')
            ->select('kodeProgram','kodeKegiatan','namaKegiatan','kodeSKPD')
            ->get();
        foreach ($data as $xdata) {
            $ada = DB::table('kegiatan')
            ->where('kodeprogram', $xdata->kodeProgram)
            ->where('kodekegiatan', $xdata->kodeKegiatan)
            ->where('kodeskpd', $xdata->kodeSKPD)
            ->count();
            if ($ada > 0) {
                DB::table('kegiatan')
                    ->where('kodeprogram', $xdata->kodeProgram)
                    ->where('kodekegiatan', $xdata->kodeKegiatan)
                    ->where('kodeskpd', $xdata->kodeSKPD)
                    ->update([ 
                        'namakegiatan' => $xdata->namaKegiatan,
                            ]);
            } else {
                DB::table('kegiatan')
                    ->insert([
                        'kodekegiatan' => $xdata->kodeKegiatan,  
                        'kodeprogram' => $xdata->kodeProgram,
                        'namakegiatan' => $xdata->namaKegiatan,
                        'kodeskpd'    => $xdata->kodeSKPD
                            ]);
            }
        }
    }


    function skpdload() {
        $data = DB::table('skpd')
        ->select('kd_skpd','nm_skpd')
        ->orderBy('nm_skpd','asc')
        ->get();

        return view('data.data_skpd', ['data' => $data]);
    }

    function programload($skpd) {
        $data = DB::table('program')
        ->select('kodeprogram','namaprogram')
        ->where('kodeskpd', $skpd)
        ->get();

        return view('data.data_program', ['data' => $data]);
    }

    function kegiatanload($program, $skpd) {
        $data = DB::table('kegiatan')
        ->select('kodekegiatan','namakegiatan')
        ->where('kodeprogram', $program)
        ->where('kodeskpd', $skpd)
        ->get();

        return view('data.data_kegiatan', ['data' => $data]);
    }

    function Rekap($bulan, $tahun) {
        $data = DB::table('skpd')
        ->select('idskpd','kd_skpd','nm_skpd')
        ->get();

        foreach ($data as $xdata) {

            $anggaran_bt = DB::table('anggaran')
            ->where('kodeSKPD', $xdata->kd_skpd)
            ->where('kodeAkunKelompok', '2')
            ->where('tahun', $tahun)
            ->get()->sum('nilaiAnggaran');

            $anggaran_bl = DB::table('anggaran')
            ->where('kodeSKPD', $xdata->kd_skpd)
            ->where('kodeAkunKelompok', '1')
            ->where('tahun', $tahun)
            ->get()->sum('nilaiAnggaran');

            $tot = $anggaran_bt + $anggaran_bl;

            $realisasi_bt = DB::table('realisasi')
            ->where('kodeSKPD', $xdata->kd_skpd)
            ->where('kodeAkunKelompok', '2')
            ->where('periode', $bulan)
            ->where('tahun', $tahun)
            ->get()->sum('nilaiRealisasi');

            $realisasi_bl = DB::table('realisasi')
            ->where('kodeSKPD', $xdata->kd_skpd)
            ->where('kodeAkunKelompok', '1')
            ->where('periode', $bulan)
            ->where('tahun', $tahun)
            ->get()->sum('nilaiRealisasi');

            $totR = $realisasi_bt + $realisasi_bl;

            $sisa = $tot - $totR;

                if($realisasi_bl != 0){
                    $realisasi_bl_new = $realisasi_bl;
                } else {
                    $realisasi_bl_new = '0';
                }
                if($anggaran_bl != 0){
                    $anggaran_bl_new = $anggaran_bl;
                } else {
                    $anggaran_bl_new = '1';
                }
                $x = ($realisasi_bl_new / $anggaran_bl_new) * 100;
                $realisasiBelanjaLangsungPersen = substr($x,0,4);

                if($realisasi_bt != 0){
                    $realisasi_bt_new = $realisasi_bt;
                } else {
                    $realisasi_bt_new = '0';
                }
                if($anggaran_bt != 0){
                    $anggaran_bt_new = $anggaran_bt;
                } else {
                    $anggaran_bt_new = '1';
                }
                $xt = ($realisasi_bt_new / $anggaran_bt_new) * 100;
                $realisasiBelanjaTidakLangsungPersen = substr($xt,0,4);


                if($tot != 0){
                    $tot_new = $tot;
                } else {
                    $tot_new = '1';
                }
                if($totR != 0){
                    $totR_new = $totR;
                } else {
                    $totR_new = '0';
                }
                $xtot = ($totR_new / $tot_new) * 100;
                $totalRealisasiPersen = substr($xtot,0,4);


            $ada = DB::table('rekap')
                    ->where('kodeskpd', $xdata->kd_skpd)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->count();
            
            if ($ada > 0) {
                DB::table('rekap')
                ->where('kodeskpd', $xdata->kd_skpd)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->update([
                    'namaskpd'                      => $xdata->nm_skpd,  
                    'anggaranBelanjaTidakLangsung'  => $anggaran_bt,
                    'anggaranBelanjaLangsung'       => $anggaran_bl,
                    'totalAnggaran'                 => $tot,
                    'realisasiBelanjaTidakLangsung' => $realisasi_bt,
                    'realisasiBelanjaLangsung'      => $realisasi_bl,
                    'realisasiBelanjaLangsungPersen'      => $realisasiBelanjaLangsungPersen,
                    'realisasiBelanjaTidakLangsungPersen'      => $realisasiBelanjaTidakLangsungPersen,
                    'totalRealisasi'                => $totR,
                    'totalRealisasiPersen'                => $totalRealisasiPersen,
                    'sisaAnggaran'                  => $sisa,
                ]);
            } else {
                DB::table('rekap')
                ->insert([
                    'kodeskpd'                      => $xdata->kd_skpd,
                    'namaskpd'                      => $xdata->nm_skpd,  
                    'anggaranBelanjaTidakLangsung'  => $anggaran_bt,
                    'anggaranBelanjaLangsung'       => $anggaran_bl,
                    'totalAnggaran'                 => $tot,
                    'realisasiBelanjaTidakLangsung' => $realisasi_bt,
                    'realisasiBelanjaLangsung'      => $realisasi_bl,
                    'realisasiBelanjaLangsungPersen'      => $realisasiBelanjaLangsungPersen,
                    'realisasiBelanjaTidakLangsungPersen'      => $realisasiBelanjaTidakLangsungPersen,
                    'totalRealisasi'                => $totR,
                    'totalRealisasiPersen'                => $totalRealisasiPersen,
                    'sisaAnggaran'                  => $sisa,
                    'bulan'                         => $bulan,
                    'tahun'                         => $tahun,
                ]);
            }
        }
        return null;
    }

    function bs() {
        $data = DB::table('skpd')
        ->select('kd_skpd','nm_skpd')
        ->get();
        foreach ($data as $xdata) {
            $ada = DB::table('rekap')
            ->where('kodeskpd', $xdata->kd_skpd)
            ->count();
            if($ada > 0) {
                DB::table('rekap')
                ->where('kodeskpd',$xdata->kd_skpd)
                ->update([
                    'namaskpd'                      => $xdata->nm_skpd,  
                    'anggaranBelanjaTidakLangsung'  => '-',
                    'anggaranBelanjaLangsung'       => '-',
                    'totalAnggaran'                 => '-',
                    'realisasiBelanjaTidakLangsung' => '-',
                    'realisasiBelanjaLangsung'      => '-',
                    'totalRealisasi'                => '-',
                    'sisaAnggaran'                  => '-',
                ]);
            } else {
                DB::table('rekap')
                ->insert([
                    'kodeskpd'                      => $xdata->kd_skpd,
                    'namaskpd'                      => $xdata->nm_skpd,  
                    'anggaranBelanjaTidakLangsung'  => '-',
                    'anggaranBelanjaLangsung'       => '-',
                    'totalAnggaran'                 => '-',
                    'realisasiBelanjaTidakLangsung' => '-',
                    'realisasiBelanjaLangsung'      => '-',
                    'totalRealisasi'                => '-',
                    'sisaAnggaran'                  => '-',
                ]);
            }
        }
    }

    function DataChart($bulan, $skpd, $tahun) {
        $data = DB::table('rekap')
        ->where('kodeskpd',$skpd)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->get();
            foreach ($data as $xdata){
                $data = array(
                    'anggaran'.$bulan   => $xdata->totalAnggaran,
                    'realisasi'.$bulan  => $xdata->totalRealisasi,
                    'efisiensi'.$bulan  => $xdata->sisaAnggaran,
                );
                return $data;
            }
    }

    function adduser() {
        $data = DB::table('skpd')
        ->select('idskpd','kd_skpd','nm_skpd')
        ->get();

        foreach ($data as $xdata) {
            $ada = DB::table('users')->where('username', $xdata->kd_skpd)->count();

            if($ada > 0){
            DB::table('users')
            ->where('username', $xdata->kd_skpd)
            ->update([
                'name'     => $xdata->nm_skpd,
                'email'    => $xdata->kd_skpd . '@sulselprov.go.id',
                'password'    => bcrypt($xdata->kd_skpd),
                'idskpd'    => $xdata->idskpd,
                'kd_skpd'    => $xdata->kd_skpd,
                'lastlogin'    => date('Y-m-d H:i:s'),
            ]);
            }else{
            DB::table('users')
                ->insert([
                    'name'     => $xdata->nm_skpd,
                    'username'    => $xdata->kd_skpd,
                    'email'    => $xdata->kd_skpd . '@sulselprov.go.id',
                    'password'    => $xdata->kd_skpd,
                    'idskpd'    => $xdata->idskpd,
                    'kd_skpd'    => $xdata->kd_skpd,
                    'lastlogin'    => date('Y-m-d H:i:s'),
                ]);
            }
        }
        return null;
    }


    function addrole() {
        $data = DB::table('users')
        ->select('id')
        ->get();

        foreach ($data as $xdata) {
            $ada = DB::table('role_user')->where('user_id', $xdata->id)->count();

            if($ada > 0){
            DB::table('role_user')
            ->where('user_id', $xdata->id)
            ->update([
                'role_id'     => '2',
                'user_type'     => 'App\User',
            ]);
            }else{
            DB::table('role_user')
                ->insert([
                    'role_id'     => '2',
                    'user_id'     => $xdata->id,
                    'user_type'     => 'App\User',
                ]);
            }
        }
        return null;
    }



}