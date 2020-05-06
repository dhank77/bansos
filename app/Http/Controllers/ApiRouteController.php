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

class ApiRouteController extends Controller {
    function index(Request $request) {
        return 'asdadas';
    }

    function dataKabkot() {
        $data = DB::table('ms_kab')
            ->select('nama_kab')
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->nama_kab);
        }

        return $result;
    }

    function dataKecamatan($name) {
        $data = DB::table('ms_kec')
            ->join('ms_kab', 'ms_kec.kd_kab', 'ms_kab.kd_kab')
            ->select('ms_kec.nama_kec')
            ->where('ms_kab.nama_kab', $name)
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->nama_kec);
        }

        return $result;
    }

    function dataKelurahan($name) {
        $data = DB::table('ms_kel')
            ->join('ms_kec', 'ms_kel.kd_kec', 'ms_kec.kd_kec')
            ->select('ms_kel.nama_kel')
            ->where('ms_kec.nama_kec', $name)
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->nama_kel);
        }

        return $result;
    }

    function dataStatusKedudukan() {
        $data = DB::table('ms_status_kedudukan')
            ->select('status_kedudukan')
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->status_kedudukan);
        }

        return $result;
    }

    function dataJenisLaporan() {
        $data = DB::table('ms_jenis_laporan')
            ->select('jenis_laporan')
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->jenis_laporan);
        }

        return $result;
    }

    function dataKategori() {
        $data = DB::table('ms_kategori')
            ->select('kategori')
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->kategori);
        }

        return $result;
    }

    function dataJenis() {
        $data = DB::table('ms_jenis')
            ->select('jenis')
            ->get();

        $result = array();

        foreach ($data as $rData) {
            array_push($result, $rData->jenis);
        }

        return $result;
    }

    function actionInsert(Request $request) {
        $tipe                   = $request->input('tipe');
        $email                  = $request->input('email');
        $nik                    = $request->input('nik');
        $nama                   = $request->input('nama');
        $no_tlp                 = $request->input('no_tlp');
        $no_wa                  = $request->input('no_wa');
        $alamat                 = $request->input('alamat');
        $kabkot                 = $request->input('kabkot');
        $kecamatan              = $request->input('kecamatan');
        $kelurahan              = $request->input('kelurahan');
        $rt                     = $request->input('rt');
        $rw                     = $request->input('rw');
        $pekerjaan              = $request->input('pekerjaan');
        $status_kedudukan       = $request->input('status_kedudukan');
        $penghasilan_sebelum    = str_replace(',', '', $request->input('penghasilan_sebelum'));
        $penghasilan_setelah    = str_replace(',', '', $request->input('penghasilan_setelah'));
        $jum_keluarga           = $request->input('jum_keluarga');
        $jenis_laporan          = $request->input('jenis_laporan');
        $kategori               = $request->input('kategori');
        $jenis                  = $request->input('jenis');
        $keterangan             = $request->input('keterangan');

        $kd_kabkot = DB::table('ms_kab')
            ->select('kd_kab')
            ->where('nama_kab', $kabkot)
            ->first()->kd_kab;
        
        $kd_kec = DB::table('ms_kec')
            ->select('kd_kec')
            ->where('nama_kec', $kecamatan)
            ->first()->kd_kec;

        $kd_kel = DB::table('ms_kel')
            ->select('kd_kel')
            ->where('nama_kel', 'like', '%'.$kelurahan)
            ->first()->kd_kel;

        $id_status_kedudukan = DB::table('ms_status_kedudukan')
            ->select('id')
            ->where('status_kedudukan', $status_kedudukan)
            ->first()->id;

        $id_jenis_laporan = DB::table('ms_jenis_laporan')
            ->select('id')
            ->where('jenis_laporan', $jenis_laporan)
            ->first()->id;
        
        $id_kategori = DB::table('ms_kategori')
            ->select('id')
            ->where('kategori', $kategori)
            ->first()->id;

        $id_jenis = DB::table('ms_jenis')
            ->select('id')
            ->where('jenis', $jenis)
            ->first()->id;

        DB::table('aduan')
            ->insert([
                'email'                 => $email,
                'nik'                   => $nik,
                'nama'                  => $nama,
                'no_tlp'                => $no_tlp,
                'no_wa'                 => $no_wa,
                'alamat'                => $alamat,
                'kd_kabkot'             => $kd_kabkot,
                'kd_kec'                => $kd_kec,
                'kd_kel'                => $kd_kel,
                'rt'                    => $rt,
                'rw'                    => $rw,
                'pekerjaan'             => $pekerjaan,
                'id_status_kedudukan'   => $id_status_kedudukan,
                'penghasilan_sebelum'   => $penghasilan_sebelum,
                'penghasilan_setelah'   => $penghasilan_setelah,
                'jum_keluarga'          => $jum_keluarga,
                'id_jenis_laporan'      => $id_jenis_laporan,
                'id_kategori'           => $id_kategori,
                'id_jenis'              => $id_jenis,
                'keterangan'            => $keterangan,
                'tipe'                  => $tipe,
            ]);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Aduan berhasil dikirim, cek status aduan anda pada icon lonceng sudut kanan aplikasi.',
        ], 200);
    }
}