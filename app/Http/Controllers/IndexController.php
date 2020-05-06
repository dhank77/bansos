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

            return view('index2',[ 'data' => $data, 'data2' => $data2]);
        }else if(Auth::check()){
            return redirect('/panel');
        }
    }
    function Persyaratan(Request $request) {
       $data = DB::table('modul_filesyarat')
        ->select('nama')
        ->where('id', '=', '1')
        ->first()->nama;
        
        return view('persyaratan',[ 'data' => $data]);
    }

    public function route(){
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        \Artisan::call('config:cache');
    }

    function APIppk() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=ppk', 'r'));
        $stream = new Psr7\CachingStream($original);
        $datappk = json_decode($stream);

        

        foreach ($datappk as $xDatappk) {

            return $datappk->ID;
            $ada = DB::table('ppk')
                ->where('id', $xDatappk->ID)
                ->count();

                if ($ada > 0) {
                    DB::table('ppk')
                    ->where('id', $xDatappk->ID)
                    ->update([
                        'id'                 => $xDatappk->ID,
                        'nama'               => $xDatappk->NAMA,
                        'jabatan'            => $xDatappk->JABATAN,
                        'alamat'             => $xDatappk->ALAMAT,
                        'status_pengguna'    => $xDatappk->STATUS_PENGGUNA,
                        'alamat'             => $xDatappk->ALAMAT,
                        'nip'                => str_replace([" ","."],"",$xDatappk->NIP),
                        'nrp'                => $xDatappk->NRP,
                        'nik'                => $xDatappk->NIK,
                        'golongan'           => $xDatappk->GOLONGAN,
                        'no_telepon'         => $xDatappk->NO_TELP,
                        'email'              => '',
                        'no_sk'              => $xDatappk->NO_SL,
                        'created_time'       => $xDatappk->CREATED_TIME,
                        'lastupdate_time'    => $xDatappk->LAST_UPDATE_TIME,
                        'tahun'              => $xDatappk->tahun
                    ]);
                } else {
                    DB::table('ppk')
                    ->whereRaw("'$xDatappk->ID' NOT EXISTS (SELECT id FROM ppk)")
                    ->insert([
                        'id'                 => $xDatappk->ID,
                        'nama'               => $xDatappk->NAMA,
                        'jabatan'            => $xDatappk->JABATAN,
                        'alamat'             => $xDatappk->ALAMAT,
                        'status_pengguna'    => $xDatappk->STATUS_PENGGUNA,
                        'alamat'             => $xDatappk->ALAMAT,
                        'nip'                => str_replace([" ","."],"",$xDatappk->NIP),
                        'nrp'                => $xDatappk->NRP,
                        'nik'                => $xDatappk->NIK,
                        'golongan'           => $xDatappk->GOLONGAN,
                        'no_telepon'         => $xDatappk->NO_TELP,
                        'email'              => '',
                        'no_sk'              => $xDatappk->NO_SL,
                        'created_time'       => $xDatappk->CREATED_TIME,
                        'lastupdate_time'    => $xDatappk->LAST_UPDATE_TIME,
                        'tahun'              => $xDatappk->tahun
                    ]);
                        // === INSERT KE TABEL USERS ===
                        $nipbaru = str_replace([" ","."],"",$xDatappk->NIP); 
                        $nipdobel = DB::table('users')->where('username', $nipbaru)->count();
                        if ($nipdobel > 0) {
                            DB::table('users')
                            ->where('username', $nipbaru)
                            ->update([
                                'name'                => $xDatappk->NAMA,
                                'username'            => str_replace([" ","."],"",$xDatappk->NIP),
                                'email'               => str_replace([" ","."],"",$xDatappk->NIP),
                                'password'            => bcrypt(str_replace([" ","."],"",$xDatappk->NIP))
                            ]);
                        } else {
                            DB::table('users')
                            ->insert([
                                'name'                => $xDatappk->NAMA,
                                'username'            => str_replace([" ","."],"",$xDatappk->NIP),
                                'email'               => str_replace([" ","."],"",$xDatappk->NIP),
                                'password'            => bcrypt(str_replace([" ","."],"",$xDatappk->NIP))
                            ]);
                        }
                        // === END INSERT KE TABEL USERS ===
                }

                $idusers = DB::table('users')->select('id')->orderBy('id','asc')->get();
                foreach ($idusers as $xIdusers) {

                    $iddobel = DB::table('role_user')->where('user_id', $xIdusers->id)->count();
                    if ($iddobel > 0) {
                        DB::table('role_user')
                        ->where('user_id', $xIdusers->id)
                        ->update([
                            'role_id'             => '2',
                            'user_id'            => $xIdusers->id,
                            'user_type'          => 'App\User',
                        ]);
                    } else {
                        DB::table('role_user')
                        ->insert([
                            'role_id'             => '2',
                            'user_id'            => $xIdusers->id,
                            'user_type'          => 'App\User',
                        ]);
                    }
                        
                }
            }
    }


    function APIStrukturAnggaran() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=anggaran', 'r'));
        $stream = new Psr7\CachingStream($original);
        $DataAnggaran = json_decode($stream);

        foreach ($DataAnggaran as $xDataAnggaran) {
            $ada = DB::table('struktur_anggaran')->where('id', $xDataAnggaran->ID)->count();

            if ($ada > 0) {
                DB::table('struktur_anggaran')
                ->where('id', $xDataAnggaran->ID)
                ->update([
                    'id'                                                     => $xDataAnggaran->ID,
                    'belanja_langsung_pegawai'                               => $xDataAnggaran->BELANJA_LANGSUNG_PEGAWAI,
                    'belanja_langsung_bukan_pegawai'                         => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI,
                    'belanja_langsung_bukan_pegawai_barangjasa'              => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI_BARANGJASA,
                    'belanja_langsung_bukan_pegawai_modal'                   => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI_MODAL,
                    'belanja_tidak_langsung_pegawai'                         => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_PEGAWAI,
                    'belanja_tidak_langsung_bukan_pegawai_bukan_pengadaan'   => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_BUKAN_PEGAWAI_BUKAN_PENGADAAN,
                    'belanja_tidak_langsung_bukan_pegawai_pengadaan'         => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_BUKAN_PEGAWAI_PENGADAAN,
                    'id_satker'                                              => $xDataAnggaran->ID_SATKER,
                    'id_kdli'                                                => $xDataAnggaran->ID_KLDI,
                ]);
            } else {
                DB::table('struktur_anggaran')
                ->insert([
                    'id'                                                     => $xDataAnggaran->ID,
                    'belanja_langsung_pegawai'                               => $xDataAnggaran->BELANJA_LANGSUNG_PEGAWAI,
                    'belanja_langsung_bukan_pegawai'                         => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI,
                    'belanja_langsung_bukan_pegawai_barangjasa'              => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI_BARANGJASA,
                    'belanja_langsung_bukan_pegawai_modal'                   => $xDataAnggaran->BELANJA_LANGSUNG_BUKAN_PEGAWAI_MODAL,
                    'belanja_tidak_langsung_pegawai'                         => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_PEGAWAI,
                    'belanja_tidak_langsung_bukan_pegawai_bukan_pengadaan'   => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_BUKAN_PEGAWAI_BUKAN_PENGADAAN,
                    'belanja_tidak_langsung_bukan_pegawai_pengadaan'         => $xDataAnggaran->BELANJA_TIDAK_LANGSUNG_BUKAN_PEGAWAI_PENGADAAN,
                    'id_satker'                                              => $xDataAnggaran->ID_SATKER,
                    'id_kdli'                                                => $xDataAnggaran->ID_KLDI,
                ]);
            }
        }
    }




    function APIPrograms() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=program', 'r'));
        $stream = new Psr7\CachingStream($original);
        $DataProgram = json_decode($stream);

        foreach ($DataProgram as $xDataProgram) {
            $ada = DB::table('program')->where('id_program', $xDataProgram->ID_PROGRAM)->count();

            if ($ada > 0) {
                DB::table('program')
                ->where('id_program', $xDataProgram->ID_PROGRAM)
                ->update([
                    'id_program'        => $xDataProgram->ID_PROGRAM,
                    'id_satker'         => $xDataProgram->ID_SATKER,
                    'nama_program'      => $xDataProgram->NAMA_PROGRAM,
                    'kode_program'      => $xDataProgram->KODE_PROGRAM,
                    'pagu'              => $xDataProgram->PAGU,
                    'is_deleted'        => $xDataProgram->IS_DELETED,
                    'create_time'       => $xDataProgram->CREATE_TIME,
                    'lastupdate_time'   => $xDataProgram->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataProgram->ALASAN_REVISI
                ]);
            } else {
                DB::table('program')
                ->insert([
                    'id_program'        => $xDataProgram->ID_PROGRAM,
                    'id_satker'         => $xDataProgram->ID_SATKER,
                    'nama_program'      => $xDataProgram->NAMA_PROGRAM,
                    'kode_program'      => $xDataProgram->KODE_PROGRAM,
                    'pagu'              => $xDataProgram->PAGU,
                    'is_deleted'        => $xDataProgram->IS_DELETED,
                    'create_time'       => $xDataProgram->CREATE_TIME,
                    'lastupdate_time'   => $xDataProgram->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataProgram->ALASAN_REVISI
                ]);
            }
        }
    }


    function APIKegiatans() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=kegiatan', 'r'));
        $stream = new Psr7\CachingStream($original);
        $DataKegiatan = json_decode($stream);

        foreach ($DataKegiatan as $xDataKegiatan) {
            $ada = DB::table('kegiatan')->where('id_kegiatan', $xDataKegiatan->ID_KEGIATAN)->count();

            if ($ada > 0) {
                DB::table('kegiatan')
                ->where('id_kegiatan', $xDataKegiatan->ID_KEGIATAN)
                ->update([
                    'id_program'        => $xDataKegiatan->ID_PROGRAM,
                    'id_kegiatan'       => $xDataKegiatan->ID_KEGIATAN,
                    'id_satker'         => $xDataKegiatan->ID_SATKER,
                    'nama_kegiatan'     => $xDataKegiatan->NAMA_KEGIATAN,
                    'kode_kegiatan'     => $xDataKegiatan->KODE_KEGIATAN,
                    'pagu'              => $xDataKegiatan->PAGU,
                    'is_deleted'        => $xDataKegiatan->IS_DELETED,
                    'create_time'       => $xDataKegiatan->CREATE_TIME,
                    'lastupdate_time'   => $xDataKegiatan->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataKegiatan->ALASAN_REVISI
                ]);
            } else {
                DB::table('kegiatan')
                ->insert([
                    'id_program'        => $xDataKegiatan->ID_PROGRAM,
                    'id_kegiatan'       => $xDataKegiatan->ID_KEGIATAN,
                    'id_satker'         => $xDataKegiatan->ID_SATKER,
                    'nama_kegiatan'     => $xDataKegiatan->NAMA_KEGIATAN,
                    'kode_kegiatan'     => $xDataKegiatan->KODE_KEGIATAN,
                    'pagu'              => $xDataKegiatan->PAGU,
                    'is_deleted'        => $xDataKegiatan->IS_DELETED,
                    'create_time'       => $xDataKegiatan->CREATE_TIME,
                    'lastupdate_time'   => $xDataKegiatan->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataKegiatan->ALASAN_REVISI
                ]);
            }
        }
    }



    function APIObjekAkun() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=objek_akun', 'r'));
        $stream = new Psr7\CachingStream($original);
        $DataObjekAkun = json_decode($stream);

        foreach ($DataObjekAkun as $xDataObjekAkun) {
            $ada = DB::table('objek_akun')->where('id_objek_akun', $xDataObjekAkun->ID_OBJEK_AKUN)->count();

            // if ($ada > 0) {
            //     DB::table('objek_akun')
            //     ->where('id_objek_akun', $xDataObjekAkun->ID_OBJEK_AKUN)
            //     ->update([
            //         'id_objek_akun'     => $xDataObjekAkun->ID_OBJEK_AKUN,
            //         'id_kegiatan'       => $xDataObjekAkun->ID_KEGIATAN,
            //         'id_program'        => $xDataObjekAkun->ID_PROGRAM,
            //         'id_satker'         => $xDataObjekAkun->ID_SATKER,
            //         'nama_objek_akun'   => $xDataObjekAkun->NAMA_OBJEK_AKUN,
            //         'kode_objek_akun'   => $xDataObjekAkun->KODE_OBJEK_AKUN,
            //         'pagu'              => $xDataObjekAkun->PAGU,
            //         'is_deleted'        => $xDataObjekAkun->IS_DELETED,
            //         'create_time'       => $xDataObjekAkun->CREATE_TIME,
            //         'lastupdate_time'   => $xDataObjekAkun->LASTUPDATE_TIME,
            //         'alasan_revisi'     => $xDataObjekAkun->ALASAN_REVISI
            //     ]);
            // } else {
                DB::table('objek_akun')
                ->insert([
                    'id_objek_akun'     => $xDataObjekAkun->ID_OBJEK_AKUN,
                    'id_kegiatan'       => $xDataObjekAkun->ID_KEGIATAN,
                    'id_program'        => $xDataObjekAkun->ID_PROGRAM,
                    'id_satker'         => $xDataObjekAkun->ID_SATKER,
                    'nama_objek_akun'   => $xDataObjekAkun->NAMA_OBJEK_AKUN,
                    'kode_objek_akun'   => $xDataObjekAkun->KODE_OBJEK_AKUN,
                    'pagu'              => $xDataObjekAkun->PAGU,
                    'is_deleted'        => $xDataObjekAkun->IS_DELETED,
                    'create_time'       => $xDataObjekAkun->CREATE_TIME,
                    'lastupdate_time'   => $xDataObjekAkun->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataObjekAkun->ALASAN_REVISI
                ]);
            // }
        }
    }


    function APIRinciObjekAkun() {

        $original = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=rinci_objek_akun', 'r'));
        $stream = new Psr7\CachingStream($original);
        $DataRinciObjekAkun = json_decode($stream);

        foreach ($DataRinciObjekAkun as $xDataRinciObjekAkun) {
            $ada = DB::table('rinci_objek_akun')->where('id_rinci_objek_akun', $xDataRinciObjekAkun->ID_RINCI_OBJEK_AKUN)->count();

            if ($ada > 0) {
                DB::table('rinci_objek_akun')
                ->where('id_rinci_objek_akun', $xDataRinciObjekAkun->ID_RINCI_OBJEK_AKUN)
                ->update([
                    'id_rinci_objek_akun'     => $xDataRinciObjekAkun->ID_RINCI_OBJEK_AKUN,
                    'id_objek_akun'     => $xDataRinciObjekAkun->ID_OBJEK_AKUN,
                    'id_kegiatan'       => $xDataRinciObjekAkun->ID_KEGIATAN,
                    'id_program'        => $xDataRinciObjekAkun->ID_PROGRAM,
                    'id_satker'         => $xDataRinciObjekAkun->ID_SATKER,
                    'nama_rinci_objek_akun'   => $xDataRinciObjekAkun->NAMA_RINCI_OBJEK_AKUN,
                    'kode_rinci_objek_akun'   => $xDataRinciObjekAkun->KODE_RINCI_OBJEK_AKUN,
                    'pagu'              => $xDataRinciObjekAkun->PAGU,
                    'is_deleted'        => $xDataRinciObjekAkun->IS_DELETED,
                    'create_time'       => $xDataRinciObjekAkun->CREATE_TIME,
                    'lastupdate_time'   => $xDataRinciObjekAkun->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataRinciObjekAkun->ALASAN_REVISI
                ]);
            } else {
                DB::table('rinci_objek_akun')
                ->insert([
                    'id_rinci_objek_akun'     => $xDataRinciObjekAkun->ID_RINCI_OBJEK_AKUN,
                    'id_objek_akun'     => $xDataRinciObjekAkun->ID_OBJEK_AKUN,
                    'id_kegiatan'       => $xDataRinciObjekAkun->ID_KEGIATAN,
                    'id_program'        => $xDataRinciObjekAkun->ID_PROGRAM,
                    'id_satker'         => $xDataRinciObjekAkun->ID_SATKER,
                    'nama_rinci_objek_akun'   => $xDataRinciObjekAkun->NAMA_RINCI_OBJEK_AKUN,
                    'kode_rinci_objek_akun'   => $xDataRinciObjekAkun->KODE_RINCI_OBJEK_AKUN,
                    'pagu'              => $xDataRinciObjekAkun->PAGU,
                    'is_deleted'        => $xDataRinciObjekAkun->IS_DELETED,
                    'create_time'       => $xDataRinciObjekAkun->CREATE_TIME,
                    'lastupdate_time'   => $xDataRinciObjekAkun->LASTUPDATE_TIME,
                    'alasan_revisi'     => $xDataRinciObjekAkun->ALASAN_REVISI
                ]);
            }
        }
    }



    function APIRinciBelanja() {

        $original         = Psr7\stream_for(fopen('http://114.7.199.67/service/gateSirup.php?format=rinci_belanja', 'r'));
        $stream           = new Psr7\CachingStream($original);
        $DataRinciBelanja = json_decode($stream);

        foreach ($DataRinciBelanja as $xDataRinciBelanja) {
            $ada = DB::table('rinci_belanja')->where('id', $xDataRinciBelanja->ID)->count();

            if ($ada > 0) {
                DB::table('rinci_belanja')
                ->where('id', $xDataRinciBelanja->ID)
                ->update([
                    'id'                      => $xDataRinciBelanja->ID,
                    'id_program'              => $xDataRinciBelanja->ID_PROGRAM,
                    'id_kegiatan'             => $xDataRinciBelanja->ID_KEGIATAN,
                    'id_objek_akun'           => $xDataRinciBelanja->ID_OBJEK_AKUN,
                    'id_rinci_objek_akun'     => $xDataRinciBelanja->ID_RINCI_OBJEK_AKUN,
                    'id_satker'               => $xDataRinciBelanja->ID_SATKER,
                    'nama_rinci_objek_akun'   => $xDataRinciBelanja->NAMA_RINCI_OBJEK_AKUN,
                    'kode_rinci_objek_akun'   => $xDataRinciBelanja->KODE_RINCI_OBJEK_AKUN,
                    'urut_head'               => $xDataRinciBelanja->URUT_HEAD,
                    'uraian_head'             => $xDataRinciBelanja->URAIAN_HEAD,
                    'urut_detail'             => $xDataRinciBelanja->URUT_DETAIL,
                    'uraian_detail'           => $xDataRinciBelanja->URAIAN_DETAIL,
                    'volume_detail'           => $xDataRinciBelanja->VOLUME_DETAIL,
                    'satuan'                  => $xDataRinciBelanja->SATUAN,
                    'harga_satuan'            => $xDataRinciBelanja->HARGA_SATUAN,
                    'pagu'                    => $xDataRinciBelanja->PAGU,
                    'is_deleted'              => $xDataRinciBelanja->IS_DELETED,
                    'create_time'             => $xDataRinciBelanja->CREATE_TIME,
                    'lastupdate_time'         => $xDataRinciBelanja->LASTUPDATE_TIME,
                    'alasan_revisi'           => $xDataRinciBelanja->ALASAN_REVISI
                ]);
            } else {
                DB::table('rinci_belanja')
                ->insert([
                    'id'                      => $xDataRinciBelanja->ID,
                    'id_program'              => $xDataRinciBelanja->ID_PROGRAM,
                    'id_kegiatan'             => $xDataRinciBelanja->ID_KEGIATAN,
                    'id_objek_akun'           => $xDataRinciBelanja->ID_OBJEK_AKUN,
                    'id_rinci_objek_akun'     => $xDataRinciBelanja->ID_RINCI_OBJEK_AKUN,
                    'id_satker'               => $xDataRinciBelanja->ID_SATKER,
                    'nama_rinci_objek_akun'   => $xDataRinciBelanja->NAMA_RINCI_OBJEK_AKUN,
                    'kode_rinci_objek_akun'   => $xDataRinciBelanja->KODE_RINCI_OBJEK_AKUN,
                    'urut_head'               => $xDataRinciBelanja->URUT_HEAD,
                    'uraian_head'             => $xDataRinciBelanja->URAIAN_HEAD,
                    'urut_detail'             => $xDataRinciBelanja->URUT_DETAIL,
                    'uraian_detail'           => $xDataRinciBelanja->URAIAN_DETAIL,
                    'volume_detail'           => $xDataRinciBelanja->VOLUME_DETAIL,
                    'satuan'                  => $xDataRinciBelanja->SATUAN,
                    'harga_satuan'            => $xDataRinciBelanja->HARGA_SATUAN,
                    'pagu'                    => $xDataRinciBelanja->PAGU,
                    'is_deleted'              => $xDataRinciBelanja->IS_DELETED,
                    'create_time'             => $xDataRinciBelanja->CREATE_TIME,
                    'lastupdate_time'         => $xDataRinciBelanja->LASTUPDATE_TIME,
                    'alasan_revisi'           => $xDataRinciBelanja->ALASAN_REVISI
                ]);
            }
        }
    }




    function APISkpdNew() {

        $original = Psr7\stream_for(fopen('http://114.7.199.66/monev/contents/json/fisikkeuangan.php?act=allfisikkeuangan&tahun=2019&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);

        $bData = $Data['data'];

        foreach ($bData as $xData) {      

            $ada = DB::table('skpd_new')
                ->where('kode', $xData['kodeskpd'])->count();

            $namaskpdold = $xData['namaskpd'];
            $namaskpdnew = substr_replace($namaskpdold,"",0,11);

            if ($ada > 0) {
                DB::table('skpd_new')
                ->where('kode', $xData['kodeskpd'])
                ->update([
                    'kode'   => $xData['kodeskpd'],
                    'nama'   => $namaskpdnew,
                ]);
            } else {
                DB::table('skpd_new')
                ->insert([
                    'kode'   => $xData['kodeskpd'],
                    'nama'   => $namaskpdnew,
                ]);
            }
        }
    }

    function APIProgram() {

        $original = Psr7\stream_for(fopen('http://114.7.199.66/monev/contents/json/fisikkeuangan.php?act=allfisikkeuangan&tahun=2019&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {   
            
            $kodeprogram = $xData['kodeprogram'];
            $namaprogram = $xData['namaprogram'];
            $kodeskpd    = $xData['kodeskpd'];

            $namaprogram = substr_replace($namaprogram,"",0,3);

            $ada = DB::table('program')
                ->where('kodeprogram', $kodeprogram)
                ->where('kodeskpd', $kodeskpd)
                ->first();

            if ($ada) {
                DB::table('program')
                ->where('kodeprogram', $kodeprogram)
                ->where('kodeskpd', $kodeskpd)
                ->update([
                    'namaprogram'   => $namaprogram,
                ]);
            } else {
                DB::table('program')
                ->insert([
                    'kodeprogram'   => $kodeprogram,
                    'namaprogram'   => $namaprogram,
                    'kodeskpd'      => $kodeskpd,
                ]);
            }
        }
    }


    function APIKegiatan() {

        $tahun = 2019;
        $bulan = '1';

        $original = Psr7\stream_for(fopen('http://114.7.199.66/monev/contents/json/fisikkeuangan.php?act=allfisikkeuangan&tahun='.$tahun.'&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {   
            
            $kodeprogram  = $xData['kodeprogram'];
            $kodekegiatan = $xData['kodekegiatan'];
            $namakegiatan = $xData['namakegiatan'];
            $kodeskpd     = $xData['kodeskpd'];

            $ada = DB::table('kegiatan')
                ->where('kodekegiatan', $kodekegiatan)
                ->where('kodeskpd', $kodeskpd)
                ->first();

            if ($ada) {
                DB::table('kegiatan')
                ->where('kodekegiatan', $kodekegiatan)
                ->where('kodeskpd', $kodeskpd)
                ->update([
                    'namakegiatan'   => $namakegiatan,
                ]);
            } else {
                DB::table('kegiatan')
                ->insert([
                    'kodeprogram'    => $kodeprogram,
                    'kodekegiatan'   => $kodekegiatan,
                    'namakegiatan'   => $namakegiatan,
                    'kodeskpd'       => $kodeskpd,
                ]);
            }
        }
    }





    function APIKepala() {

        $original = Psr7\stream_for(fopen('https://eplanning.sulselprov.go.id/monev/contents/json/fisikkeuangan.php?act=allfisikkeuanganapi&tahun=2019&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {   
            
            $nip  = $xData['nipeselon2'];
            $nama = $xData['namaeselon2'];
            $kodeskpd     = $xData['kodeskpd'];
            $opd     = $xData['namaskpd'];

            $ada = DB::table('kepala_skpd')
                ->where('kodeskpd', $kodeskpd)
                ->first();

            if ($ada) {
                DB::table('kepala_skpd')
                ->where('kodeskpd', $kodeskpd)
                ->update([
                    'nip'    => $nip,
                    'nama'   => $nama,
                ]);
            } else {
                DB::table('kepala_skpd')
                ->insert([
                    'nip'    => $nip,
                    'nama'   => $nama,
                    'kodeskpd'       => $kodeskpd,
                    'opd'       => $opd,
                ]);
            }
        }  
    }

    function APIBidang() {

        $original = Psr7\stream_for(fopen('https://eplanning.sulselprov.go.id/monev/contents/json/fisikkeuangan.php?act=allfisikkeuanganapi&tahun=2019&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {   
            
            $id  = $xData['idpbidangskpd'];
            $nama  = $xData['namabidangskpd'];
            $kodeskpd     = $xData['kodeskpd'];

            $ada = DB::table('bidangapi')
                ->where('namabidang', $nama)
                ->where('id_api', $id)
                ->first();

            if ($ada) {
                DB::table('bidangapi')
                ->where('namabidang', $nama)
                ->where('id_api', $id)
                ->update([
                    'namabidang'    => $nama,
                ]);
            } else {
                DB::table('bidangapi')
                ->insert([
                    'id_api'   => $id,
                    'namabidang'   => $nama,
                    'kodeskpd'       => $kodeskpd,
                ]);
            }
        }  
    }


    function APIsBidang() {

        $original = Psr7\stream_for(fopen('https://eplanning.sulselprov.go.id/monev/contents/json/fisikkeuangan.php?act=allfisikkeuanganapi&tahun=2019&rbulan=1', 'r'));
        $stream = new Psr7\CachingStream($original);
        $Data = json_decode($stream, true);
        $bData = $Data['data'];

        foreach ($bData as $xData) {   
            
            $bidang  = $xData['namabidangskpd'];
            $subbidang  = $xData['namasubbidangskpd'];
            $kodeskpd     = $xData['kodeskpd'];

            $ada = DB::table('subbidangapi')
                ->where('namasubbidang', $subbidang)
                ->where('kodeskpd', $kodeskpd)
                ->first();

            if ($ada) {
                DB::table('subbidangapi')
                ->where('namasubbidang', $subbidang)
                ->where('kodeskpd', $kodeskpd)
                ->update([
                    'namasubbidang'    => $subbidang,
                ]);
            } else {
                DB::table('subbidangapi')
                ->insert([
                    'namabidang'   => $bidang,
                    'namasubbidang'   => $subbidang,
                    'kodeskpd'       => $kodeskpd,
                ]);
            }
        }  
    }






















































    function insertLaporan() {
        $email = Input::get('email');
        $link = Input::get('link');
        $desc = Input::get('desc');
        $tgl = date('YmdHis');

        if (Input::file('file')!=null) {

        $extensiFile = Input::file('file')->getClientOriginalExtension();
        $namaFile = date('YmdHis').".".$extensiFile;
        Input::file('file')->move("assets_public/file/", $namaFile);

        } else {
            $namaFile = "Tidak Ada Lampiran";
        }

        DB::table('sbb_laporan')
                ->insert([

                    'email' => $email,
                    'link' => $link,
                    'desc' => $desc,
                    'lampiran' => $namaFile,
                    'createAt' => $tgl

                ]);

        Session::flash('alertSuccess', 'Berhasil Mengirim Laporan');
        return Redirect::to(route('index'));
    }

    function cariberitahoax($id) {

        $p = str_replace(",", " ", $id);

        $berita = DB::table('postberita')
                ->where('judul', 'LIKE', '%'.$p.'%')
                ->orderBy('createdAt', 'desc')
                ->paginate(3);

        return view('data.data_berita', ['berita' => $berita]);
    }

    function produk(Request $request) {

        $produk = DB::table('postproduk')
                ->join('produkkategori', 'postproduk.kategori','produkkategori.id_kategori')
                ->select('postproduk.id','postproduk.tgl','postproduk.nama','postproduk.file','postproduk.judul','postproduk.tahun', 'produkkategori.namakategori')
                ->orderBy('tgl', 'desc')
                ->paginate(3);

        $kategori = DB::table('produkkategori')
                ->select('id_kategori','namakategori')
                ->orderBy('id_kategori')
                ->get();

        $berita = DB::table('postberita')
                ->select('id','judul')
                ->orderBy('id')
                ->limit(5)
                ->get();

        if ($request->ajax()) {
            return View('data.data_produk', ['produk' => $produk, 'kategori' => $kategori, 'berita' => $berita])->render();  
        }

        return view('daftar_produk', ['produk' => $produk, 'kategori' => $kategori, 'berita' => $berita]);
    }

    function cariProduk($id) {

        $p = str_replace(",", " ", $id);

        $produk = DB::table('postberita')
                ->where('judul', 'LIKE', '%'.$p.'%')
                ->orderBy('tgl', 'desc')
                ->paginate(3);

        return view('data.data_produk', ['produk' => $produk]);
    }

    function downloadProduk($id) {

        $produk = DB::table('postproduk')
                ->where('id', $id)
                ->select('download')
                ->first()->download;

        $jumlah = $produk + 1;

        DB::table('postproduk')
                ->where('id', '=', $id)
                ->update([

                    'download' => $jumlah

                ]);

        return null;
    }

    function cariKategori($id) {

        $p = str_replace(",", " ", $id);

        $produk = DB::table('postproduk')
                ->join('produkkategori', 'postproduk.kategori','produkkategori.id_kategori')
                ->select('postproduk.id','postproduk.tgl','postproduk.nama','postproduk.judul','postproduk.tahun', 'produkkategori.namakategori')
                ->where('produkkategori.namakategori', 'LIKE', '%'.$p.'%')
                ->orderBy('tgl', 'desc')
                ->paginate(3);

        return view('data.data_produk', ['produk' => $produk]);
    }

    function kategori() {

        $kategori = DB::table('produkkategori')
                ->select('id_kategori','namakategori')
                ->orderBy('id_kategori')
                ->get();

        return view('data.kategori', ['kategori' => $kategori]);
    }

    function berita($id) {

        $berita = DB::table('postberita')
                ->where('id', $id)
                ->get();

        $lama = DB::table('postberita')->where('id', $id)->first()->baca;

        $baru = $lama + 1;

        DB::table('postberita')
        ->where('id', '=', $id)
        ->update([ 'baca' => $baru ]);

        $beritaterbaru = DB::table('postberita')
                ->orderBy('createdAt','desc')
                ->limit(3)->get();

        return view('berita_view', ['beritaterbaru' => $beritaterbaru, 'berita' => $berita]);
    }

    function beritaTerbaru() {
        $berita = DB::table('postberita')
                ->orderBy('id')
                ->limit(5)
                ->get();

        return view('data.berita_terbaru', ['berita' => $berita]);
    }

    function detailBerita($id) {
        $berita = DB::table('postberita')
                ->orderBy('id')
                ->where('id', $id)
                ->get();

        return view('detail_berita', ['berita' => $berita]);
    }

    function detailProduk($id) {
        
        $produk = DB::table('postproduk')
                ->join('produkkategori', 'postproduk.kategori','produkkategori.id_kategori')
                ->join('status', 'postproduk.status','status.id_status')
                ->select('postproduk.id','postproduk.tgl','postproduk.nama','postproduk.file','postproduk.status','postproduk.judul','postproduk.tahun','postproduk.download', 'produkkategori.namakategori','status.namastatus')
                ->where('postproduk.id', $id)
                ->get();

        $kategori = DB::table('produkkategori')
                ->select('id_kategori','namakategori')
                ->orderBy('id_kategori')
                ->get();

        return view('detail_produk', ['produk' => $produk, 'kategori' => $kategori]);
    }

    function profil() {
        $profil = DB::table('profil')
                ->select('desc')
                ->first();

        return view('profil', ['profil' => $profil]);
    }

    function struktur() {
        $struktur = DB::table('struktur')
                ->select('desc')
                ->first();

        return view('struktur', ['struktur' => $struktur]);
    }

    function post(Request $request, $submenu) {
        $post = DB::table('post')
                ->select('title', 'desc', 'img', 'slug', 'createdAt')
                ->where('submenu', '=', $submenu)
                ->orderBy('createdAt', 'desc')
                ->paginate(6);

        $submenu = DB::table('postSubmenu')
                        ->select('submenu', 'displayName')
                        ->where('submenu', '=', $submenu)
                        ->first();

        if ($request->ajax()) {
            return View('data.data_berita', ['post' => $post, 'submenu' => $submenu])->render();  
        }

        return view('post', ['post' => $post, 'submenu' => $submenu]);
    }

    function postView($submenu, $slug) {
        $post = DB::table('post')
                ->select('id', 'title', 'desc', 'img', 'slug', 'createdAt')
                ->where('slug', '=', $slug)
                ->first();

        $submenu = DB::table('postSubmenu')
                ->select('submenu', 'displayName')
                ->where('submenu', '=', $submenu)
                ->first();

        return view('postView', ['post' => $post, 'submenu' => $submenu]);
    }

    function galeri() {
        $galeri = DB::select("SELECT title, (SELECT img FROM galeriPicture WHERE idGaleri = galeri.id LIMIT 1) AS img, `desc`, slug, createdAt FROM galeri ORDER BY createdAt DESC LIMIT 8");

        return view('galeri', ['galeri' => $galeri]);
    }

    function galeriView($slug) {
        $galeriTitle = DB::table('galeri')
                ->select('id', 'title', 'desc')
                ->where('slug', '=', $slug)
                ->first();
        
        $galeriImg = DB::table('galeriPicture')
                ->select('img')
                ->where('idGaleri', '=', $galeriTitle->id)
                ->get();

        return view('galeriView', ['galeriTitle' => $galeriTitle, 'galeriImg' => $galeriImg]);
    }

    public function agenda() {
        $agenda = DB::table('agenda')
                    ->select('hari', 'tanggal', 'pejabat', 'lokasi', 'kegiatan')
                    ->get();

        return view('agenda', ['agenda' => $agenda]);
    }

    public function agendapilih($bulan, $tahun) {

        $agenda = DB::table('agenda')
                    ->select('hari', 'tanggal', 'pejabat', 'lokasi', 'kegiatan')
                    ->whereMonth('bulan', '=', $bulan)
                    ->whereYear('bulan', '=', $tahun)
                    ->get();

        return view('data.data_agenda', ['agenda' => $agenda]);
    }

    public function downloads() {
        $download = DB::table('download')
                        ->select('id', 'title', 'file', 'created_at')
                        ->get();

        return view('download', ['download' => $download]);
    }

    public function downloadfile($nama_file) {
        $file_path = 'assets/download/'.$nama_file; 
 
        if (file_exists($file_path)) { 
            return \Response::download($file_path, $nama_file); 
        } else {
            return Redirect::to(route('download.file'));
        }
    }
}
