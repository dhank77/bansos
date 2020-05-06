<?php

namespace App\Http\Controllers\Panel;

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
use lists;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PenerimaImport;

class IndexController extends Controller {
    function index() {
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update(['lastlogin' => date('Y-m-d H:i:s') ]);
        return view('panel.dashboard');
    }

    function IndexDaerah() {
        return view('panel.dataDaerah');
    }

    function DaerahJSON() {
        $data = DB::table('ms_kab')
                ->select('id','kd_kab','nama_kab')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('kd_kab', function ($data)  {
                return '    <p>'.$data->kd_kab.'</p>';
            })
            ->editColumn('nama_kab', function ($data)  {
                return '    <p>'.$data->nama_kab.'</p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->kd_kab.'&quot;,&quot;'.$data->nama_kab.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function DaerahInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Kode'      => 'required',
            'Nama'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_kab')
                    ->insert([
                        'kd_kab'        => $request->Kode,
                        'nama_kab'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function DaerahEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('t_daerah')
                    ->where('id',$request->id)
                    ->update([
                        'namadaerah'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function DaerahDelete($id) {
        DB::table('t_daerah')
                ->where('id','=', $id)
                ->delete();
        return null;
    }


    function IndexBansos() {
        $kab = DB::table('ms_kab')
                ->select('id','kd_kab','nama_kab')
                ->get();

        return view('panel.dataBansos', [ 'kab' => $kab ]);
    }

    function DataKec($id) {
        $kec = DB::table('ms_kec')
                ->select('kd_kec','nama_kec')
                ->where('kd_kab', $id)
                ->get();

        return view('data.datakecamatan', [ 'kec' => $kec ]);
    }

    function DataKel($kab, $kec) {
        $kel = DB::table('ms_kel')
                ->select('kd_kel','nama_kel')
                ->where('kd_kab', $kab)
                ->where('kd_kec', $kec)
                ->get();

        return view('data.datakelurahan', [ 'kel' => $kel ]);
    }

    function Canvas() {
        return view('grafik');
    }
    function IndexNonBansos() {
        return view('nonbansos');
    }

    function BansosInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'IDBDT'      => 'required',
            'alamat'     => 'required',
            'nama'       => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            $prov = DB::table('ms_provinsi')
                ->where('kd_prov', $request->KD_PROV)
                ->first();

            $kab = DB::table('ms_kab')
                ->where('kd_kab', $request->KD_KAB)
                ->first();

            $kec = DB::table('ms_kec')
                ->where('kd_kab', $request->KD_KAB)
                ->where('kd_kec', $request->KD_KEC)
                ->first();

            $kel = DB::table('ms_kec')
                ->where('kd_kab', $request->KD_KAB)
                ->where('kd_kec', $request->KD_KEC)
                ->first();

            DB::table('t_penerima')
                    ->insert([
                        'IDARTBDT'        => $request->IDARTBDT,
                        'IDBDT'           => $request->IDBDT,
                        'KD_PROV'         => $request->KD_PROV,
                        'KD_KAB'          => $request->KD_KAB,
                        'KD_KEC'          => $request->KD_KEC,
                        'KD_KEL'          => $request->KD_KEL,
                        'PROVINSI'        => $prov->nama_prov,
                        'KABUPATEN'       => $kab->nama_kab,
                        'KECAMATAN'       => $kec->nama_kec,
                        'DESA_KELURAHAN'  => $request->IDARTBDT,
                        'ALAMAT'          => $request->alamat,
                        'NAMA_SLS'        => $request->nama_sls,
                        'NAMA'            => $request->nama,
                        'JENIS_KELAMIN'   => $request->jenis_kelamin,
                        'TEMPAT_LAHIR'    => $request->tempat_lahir,
                        'TANGGAL_LAHIR'   => $request->tanggal_lahir,
                        'USIA'            => $request->usia,
                        'NIK'             => $request->nik,
                        'NO_KK'           => $request->kk,
                        'JUMLAH_ART'      => $request->jumlah_art,
                        'PERSENTIL'       => $request->persentil,
                    ]);
            return null;
        }
        
    }

    function BansosJSON() {
        $data = DB::table('t_penerima')
                ->select('ID','NAMA','ALAMAT','IDBDT','KABUPATEN','JUMLAH_ART','PERSENTIL')
                ->orderBy('ID','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('IDBDT', function ($data)  {
                return '    <p>'.$data->IDBDT.'</p>';
            })
            ->editColumn('NAMA', function ($data)  {
                return '    <p>'.$data->NAMA.'</p>';
            })
            ->editColumn('KABUPATEN', function ($data)  {
                return '    <p>'.$data->KABUPATEN.'</p>';
            })
            ->editColumn('ALAMAT', function ($data)  {
                return '    <p>'.$data->ALAMAT.'</p>';
            })
            ->editColumn('JUMLAH_ART', function ($data)  {
                return '    <p>'.$data->JUMLAH_ART.'</p>';
            })
            ->editColumn('PERSENTIL', function ($data)  {
                return '    <p>'.$data->PERSENTIL.'</p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->ID.'&quot;,&quot;'.$data->NAMA.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->ID.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function BansosIndexJSON($kab, $kec, $kel) {

        if($kab == '00') {
            $data = DB::table('t_penerima')
                ->select('ID','NAMA','ALAMAT','IDBDT','KABUPATEN','JUMLAH_ART','NIK')
                ->orderBy('ID','asc');
        }else{

            if($kec == '00'){
                $data = DB::table('t_penerima')
                    ->select('ID','NAMA','ALAMAT','IDBDT','KABUPATEN','JUMLAH_ART','NIK')
                    ->where('KD_KAB',$kab)
                    ->orderBy('ID','asc');
            }else{

                if($kel == '00'){
                    $data = DB::table('t_penerima')
                    ->select('ID','NAMA','ALAMAT','IDBDT','KABUPATEN','JUMLAH_ART','NIK')
                    ->where('KD_KAB',$kab)
                    ->where('KD_KEC',$kec)
                    ->orderBy('ID','asc');
                } else {
                    $data = DB::table('t_penerima')
                    ->select('ID','NAMA','ALAMAT','IDBDT','KABUPATEN','JUMLAH_ART','NIK')
                    ->where('KD_KAB',$kab)
                    ->where('KD_KEC',$kec)
                    ->where('KD_KEL',$kel)
                    ->orderBy('ID','asc');

                }
                
            }
            
        }
        

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('IDBDT', function ($data)  {
                return '    <p>'.$data->IDBDT.'</p>';
            })
            ->editColumn('NIK', function ($data)  {
                return '    <p>'.$data->NIK.'</p>';
            })
            ->editColumn('NAMA', function ($data)  {
                return '    <p>'.$data->NAMA.'</p>';
            })
            ->editColumn('KABUPATEN', function ($data)  {
                return '    <p>'.$data->KABUPATEN.'</p>';
            })
            ->editColumn('ALAMAT', function ($data)  {
                return '    <p>'.$data->ALAMAT.'</p>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function ChartData() {
        $data = DB::table('ms_kab')
                ->selectRaw("ms_kab.nama_kab,
                    (SELECT COUNT(ID) FROM t_penerima WHERE KD_KAB = ms_kab.kd_kab) as jumlah
                    ")
                ->orderby('jumlah','desc')
                ->get();
        return $data;
    }

    function tes2() {
        $data = DB::table('ms_kel')
                ->select('id','kd_kec_old')
                ->get();

        foreach($data as $xdata){

            // $kd_kel_new = str_replace("a","", $xdata->kd_kel);

            $kd_kec_new = substr_replace( $xdata->kd_kec_old ,"",0,4);

            // $kd_kab_new = substr_replace( $xdata->kd_kec ,"",4);
            // $kd_kab_new = substr_replace( $kd_kab_new ,"",0,2);

            DB::table('ms_kel')
                ->where('id', $xdata->id)
                ->update([ 'kd_kec' => $kd_kec_new ]);

        }
            
    }

    function tes() {

    }

    function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_penerima',$nama_file);
 
		// import data
		Excel::import(new PenerimaImport, public_path('file_penerima/'.$nama_file));
 
		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/panel');
	}













    function Data($periode) {
        $usul = DB::table('t_penerima')
            ->where('status', '1')
            ->where('id_periode', $periode)
            ->count();

        $terima = DB::table('t_penerima')
            ->where('status', '2')
            ->where('id_periode', $periode)
            ->count();

        $tolak = DB::table('t_penerima')
            ->where('status', '3')
            ->where('id_periode', $periode)
            ->count();

            $data = array(
                'usul'      => $usul,
                'terima'      => $terima,
                'tolak'      => $tolak,
            );
    
            return $data;
    }


    function DataRekap($periode) {
        $dataunker = DB::table('mt_unit_kerja')
            ->selectRaw("
                mt_unit_kerja.*,
                (SELECT COUNT(id_penerima) FROM t_penerima WHERE id_periode = '".$periode."' AND proses = 'Y' AND status = '1' AND id_unker = mt_unit_kerja.id_unker) as datausul,
                (SELECT COUNT(id_penerima) FROM t_penerima WHERE id_periode = '".$periode."' AND proses = 'Y' AND status = '2' AND id_unker = mt_unit_kerja.id_unker) as datasetujui,
                (SELECT COUNT(id_penerima) FROM t_penerima WHERE id_periode = '".$periode."' AND proses = 'Y' AND status = '3' AND id_unker = mt_unit_kerja.id_unker) as datatolak
                ")
            ->orderBy('unker','asc')
            ->get();

        return view('data.dataRekap',['dataunker' => $dataunker]);
    }

    function IndexPegawai() {
        return view('panel.pegawai');
    }

    function DataPegawai($unker) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->where('mt_pegawai.kdkunker', $unker)
            ->get();
        return view('data.dataPegawai',['data' => $data]);
    }

    function DataUnker() {
        $data = DB::table('mt_unit_kerja')->orderBy('unker','asc')->get();
        return view('data.dataUnker',['data' => $data]);
    }
    function DataAgama() {
        $data = DB::table('mt_agama')->orderBy('id_agama','asc')->get();
        return view('data.dataAgama',['data' => $data]);
    }
    function DataJenisKelamin() {
        $data = DB::table('mt_jk')->orderBy('id_jk','asc')->get();
        return view('data.dataJeniskelamin',['data' => $data]);
    }
    function DataStatusKerja() {
        $data = DB::table('mt_status_kerja')->orderBy('id_sker','asc')->get();
        return view('data.dataStatuskerja',['data' => $data]);
    }
    function DataTMTGol() {
        $data = DB::table('mt_golongan')->orderBy('id_gol','asc')->get();
        return view('data.dataGolongan',['data' => $data]);
    }
    function DataJabatan() {
        $data = DB::table('mt_jabatan')->orderBy('nama_jab','asc')->get();
        return view('data.dataJabatan',['data' => $data]);
    }
    function DataEselon() {
        $data = DB::table('mt_eselon')->orderBy('id_eselon','asc')->get();
        return view('data.dataEselon',['data' => $data]);
    }
    function DataPendidikan() {
        $data = DB::table('mt_pendidikan')->orderBy('id_pend','asc')->get();
        return view('data.dataPendidikan',['data' => $data]);
    }
    function DataDiklat() {
        $data = DB::table('mt_diklat')->orderBy('id_diklat','asc')->get();
        return view('data.dataDiklat',['data' => $data]);
    }
    function DataPeriode() {
        $data = DB::table('t_periode')->where('tampil','Y')->where('aktif','Y')->orderBy('id_periode','asc')->get();
        return view('data.dataPeriode',['data' => $data]);
    }
    function XXX() {
        $data = DB::table('t_penerima')
            ->where('id_periode', '18')
            ->where('status', '1')
            ->get();
        return $data;
    }

    function PegawaiInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Nip'      => 'required',
            'NamaPegawai'      => 'required',
            'TanggalLahir'      => 'required',
            'TempatLahir'      => 'required',
            'Alamat'      => 'required',
            'Agama'      => 'required',
            'JenisKelamin'      => 'required',
            'StatusKerja'      => 'required',
            'TMTCpns'      => 'required',
            'TMTGol'      => 'required',
            'TanggalGolongan'      => 'required',
            'Jabatan'      => 'required',
            'Eselon'      => 'required',
            'TanggalLantik'      => 'required',
            'Pendidikan'      => 'required',
            'Jurusan'      => 'required',
            'TanggalLulus'      => 'required',
            'Diklat'      => 'required',
            'TanggalDiklat'      => 'required',
            'UnitKerja'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('mt_pegawai')
                    ->insert([
                        'nip'       => $request->Nip,
                        'nama'        => $request->NamaPegawai,
                        'tgl_lahir'        => $request->TanggalLahir,
                        'kota_lahir'        => $request->TempatLahir,
                        'alamat'        => $request->Alamat,
                        'agama'        => $request->Agama,
                        'jkel'        => $request->JenisKelamin,
                        'nama'        => $request->NamaPegawai,
                        'status'        => $request->StatusKerja,
                        'tmtcpns'        => $request->TMTCpns,
                        'golru'        => $request->TMTGol,
                        'tmgolru'        => $request->TanggalGolongan,
                        'jabatan'        => $request->Jabatan,
                        'eselon'        => $request->Eselon,
                        'tmtlantik'        => $request->TanggalLantik,
                        'pendumum'        => $request->Pendidikan,
                        'jurusan'        => $request->Jurusan,
                        'tsttb'        => $request->TanggalLulus,
                        'dikstr'        => $request->Diklat,
                        'ststtpp'        => $request->TanggalDiklat,
                        'kdkunker'        => $request->UnitKerja,
                        'periode_10'        => '0',
                        'periode_20'        => '0',
                        'periode_30'        => '0',
                        'no_kepres_10'        => '',
                        'no_kepres_20'        => '',
                        'no_kepres_30'        => '',
                    ]);
            return null;
        }
    }


    function PegawaiEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'             => 'required',
            'Nip'            => 'required',
            'NamaPegawai'    => 'required',
            'TanggalLahir'   => 'required',
            'TempatLahir'    => 'required',
            'Alamat'         => 'required',
            'Agama'          => 'required',
            'JenisKelamin'   => 'required',
            'StatusKerja'    => 'required',
            'TMTCpns'        => 'required',
            'TMTGol'         => 'required',
            'TanggalGolongan'   => 'required',
            'Jabatan'           => 'required',
            'Eselon'            => 'required',
            'TanggalLantik'     => 'required',
            'Pendidikan'        => 'required',
            'Jurusan'           => 'required',
            'TanggalLulus'      => 'required',
            'Diklat'            => 'required',
            'TanggalDiklat'     => 'required',
            'UnitKerja'         => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('mt_pegawai')
                    ->where('id_p', $request->id)
                    ->update([
                        'nip'         => $request->Nip,
                        'nama'        => $request->NamaPegawai,
                        'tgl_lahir'   => $request->TanggalLahir,
                        'kota_lahir'  => $request->TempatLahir,
                        'alamat'      => $request->Alamat,
                        'agama'       => $request->Agama,
                        'jkel'        => $request->JenisKelamin,
                        'nama'        => $request->NamaPegawai,
                        'status'      => $request->StatusKerja,
                        'tmtcpns'     => $request->TMTCpns,
                        'golru'       => $request->TMTGol,
                        'tmgolru'     => $request->TanggalGolongan,
                        'jabatan'     => $request->Jabatan,
                        'eselon'      => $request->Eselon,
                        'tmtlantik'   => $request->TanggalLantik,
                        'pendumum'    => $request->Pendidikan,
                        'jurusan'     => $request->Jurusan,
                        'tsttb'       => $request->TanggalLulus,
                        'dikstr'      => $request->Diklat,
                        'ststtpp'     => $request->TanggalDiklat,
                        'kdkunker'    => $request->UnitKerja,
                        'no_kepres_10'    => $request->P10,
                        'no_kepres_20'    => $request->P20,
                        'no_kepres_30'    => $request->P30,
                    ]);
            return null;
        }
    }

    function PegawaiDelete($id) {
            DB::table('mt_pegawai')
                    ->where('id_p','=', $id)
                    ->delete();
            return null;
    }

    function IndexUsulanPegawai() {
        return view('panel.usulanPegawai');
    }

    function DataUsulanPegawai($unker) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->where('mt_pegawai.kdkunker', $unker)
            ->get();
        return view('data.dataUsulanPegawai',['data' => $data]);
    }

    function PegawaiUsulanInsert(Request $request) {
        $validator = Validator::make(request()->all(),[ ]);
        if ($validator->fails()) {
             return false;
        } else {

            $cek = DB::table('t_penerima')
                    ->where('id_p', $request->id)
                    ->where('id_periode', $request->Periode)
                    ->where('proses', 'T')
                    ->where('status', '1')
                    ->count();

            if($cek > 0){
                Session::flash('alertGagal', 'Gagal Mengusulkan! Pegawai telah diusulkan sebelumnya');
                return Redirect::to(route('panel.usulan.pegawai'));
            } else {

                if ($request->PeriodeSekarang == '10'){
                    $periode_10 = '1';
                    $periode_20 = '0';
                    $periode_30 = '0';

                    DB::table('mt_pegawai')
                        ->where('id_p', $request->id)
                        ->update([
                            'periode_10'    => '1',
                        ]);
                } else if ($request->PeriodeSekarang == '20') {
                    $periode_10 = '0';
                    $periode_20 = '1';
                    $periode_30 = '0';

                    DB::table('mt_pegawai')
                        ->where('id_p', $request->id)
                        ->update([
                            'periode_20'    => '1',
                        ]);
                } else {
                    $periode_10 = '0';
                    $periode_20 = '0';
                    $periode_30 = '1';

                    DB::table('mt_pegawai')
                        ->where('id_p', $request->id)
                        ->update([
                            'periode_30'    => '1',
                        ]);
                }

                $idpenerima = DB::table('t_penerima')
                        ->insertGetId([
                            'id_periode'    => $request->Periode,
                            'id_p'          => $request->id,
                            'id_unker'      => $request->Unker,
                            'sk_pertama'    => '',
                            'sk_terakhir'   => '',
                            'sk_jabatan'    => '',
                            'konversi_nip'  => '',
                            'pernyataan'    => '',
                            'persetujuan'   => '',
                            'berkas'        => '',
                            'file_tambahan' => '',
                            'periode_10'    => $periode_10,
                            'periode_20'    => $periode_20,
                            'periode_30'    => $periode_30,
                            'proses'        => 'T',
                            'status'        => '1',
                            'alasan'        => '',
                            'user_buat'     => '1',
                            'tanggal_buat'  => date('Y-m-d'),
                            'user_ubah'     => '1',
                            'tanggal_ubah'  => date('Y-m-d'),
                        ]);
    
                        foreach ($request->file('file') as $files){
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $length = 5;
                            $randomString = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                }
        
                            $extensis = $files->getClientOriginalExtension();
                            $nama = date('YmdHis') . $randomString . '.' . $extensis;
                            $files->move('fileberkas/', $nama);
                            
                            DB::table('t_berkas')
                            ->insert([
                                'id_penerima' => $idpenerima,
                                'file' => $nama,
                            ]);
                        }
    
                    Session::flash('alertSuccess', 'Berhasil Mengusulkan');
                    return Redirect::to(route('panel.usulan.pegawai'));

            }
        }
    }

    function IndexPeriode() {
        return view('panel.periode');
    }
    function DataMsPeriode() {
        $data = DB::table('t_periode')->get();
        return view('data.dataMsPeriode',['data' => $data]);
    }

    function DataMsPeriodeInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'TahunPeriode'      => 'required',
            'NamaPeriode'      => 'required',
            'TanggalHitung'      => 'required',
            'Tampil'      => 'required',
            'Aktif'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('t_periode')
                    ->insert([
                        'tahun_periode'       => $request->TahunPeriode,
                        'nama_periode'        => $request->NamaPeriode,
                        'tanggal_hitung'        => $request->TanggalHitung,
                        'tampil'        => $request->Tampil,
                        'aktif'        => $request->Aktif,
                        'user_buat'        => '1',
                        'tanggal_buat'        => date('Y-m-d'),
                        'user_ubah'         => '1',
                        'tanggal_ubah'        => date('Y-m-d'),
                    ]);
            return null;
        }
    }

    function DataMsPeriodeEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'      => 'required',
            'TahunPeriode'      => 'required',
            'NamaPeriode'      => 'required',
            'TanggalHitung'      => 'required',
            'Tampil'      => 'required',
            'Aktif'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('t_periode')
                    ->where('id_periode', $request->id)
                    ->update([
                        'tahun_periode'       => $request->TahunPeriode,
                        'nama_periode'        => $request->NamaPeriode,
                        'tanggal_hitung'      => $request->TanggalHitung,
                        'tampil'              => $request->Tampil,
                        'aktif'               => $request->Aktif,
                        'user_buat'           => '1',
                        'tanggal_buat'        => date('Y-m-d'),
                        'user_ubah'           => '1',
                        'tanggal_ubah'        => date('Y-m-d'),
                    ]);
            return null;
        }
    }

    function LaporanSkpd($unker) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->join('mt_unit_kerja','mt_pegawai.kdkunker','mt_unit_kerja.id_unker')
            ->where('mt_pegawai.kdkunker', $unker)
            ->get();

        $pdf = PDF::loadview('panel.laporanSatya',['data' => $data])->setPaper('legal', 'landscape');
        return $pdf->save('filelaporan/laporanskpd'.$unker.'.pdf');
    }
    function LaporanSemua($periode) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->join('mt_unit_kerja','mt_pegawai.kdkunker','mt_unit_kerja.id_unker')
            ->join('mt_eselon','mt_pegawai.eselon','mt_eselon.id_eselon')
            ->join('t_penerima','mt_pegawai.id_p','t_penerima.id_p')
            ->where('t_penerima.status','2')
            ->where('t_penerima.proses','Y')
            ->where('t_penerima.id_periode', $periode)
            ->get();

        $pdf = PDF::loadview('panel.laporanSatya2',['data' => $data])->setPaper('legal', 'portrait');
        return $pdf->save('filelaporan/laporanall.pdf');
    }

    function IndexLaporan() {
        return view('panel.pagelaporan');
    }
    function IndexLaporanSemua() {
        return view('panel.pagelaporanall');
    }

    function SyaratInsert(Request $request) {
        $file = $request->file('nama');
        $extensi = $file->getClientOriginalExtension();
        $namafile = date('YmdHis') .'.'. $extensi;
        $file->move('filesyarat/', $namafile);

        DB::table('modul_filesyarat')
            ->where('id', '1')
            ->update([
                'nama'    => $namafile,
            ]);

        Session::flash('alertSuccess', 'Berhasil');
        return view('panel.filesyarat');
    }


    function IndexPenerimaPenghargaan() {
        return view('panel.penerimaPenghargaan');
    }

    function DataPenerimaPengargaanUsulan($unker, $periode) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->join('t_penerima','mt_pegawai.id_p','t_penerima.id_p')
            ->where('mt_pegawai.kdkunker', $unker)
            ->where('t_penerima.id_periode', $periode)
            ->where('t_penerima.proses', 'T')
            ->where('t_penerima.status', '1')
            ->get();
        return view('data.dataPenerima1',['data' => $data]);
    }

    function DataPenerimaPengargaanTerima($unker, $periode) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->join('t_penerima','mt_pegawai.id_p','t_penerima.id_p')
            ->where('mt_pegawai.kdkunker', $unker)
            ->where('t_penerima.id_periode', $periode)
            ->where('t_penerima.proses', 'Y')
            ->where('t_penerima.status', '2')
            ->get();
        return view('data.dataPenerima2',['data' => $data]);
    }

    function DataPenerimaPengargaanTolak($unker, $periode) {
        $data = DB::table('mt_pegawai')
            ->join('mt_golongan','mt_pegawai.golru','mt_golongan.id_gol')
            ->join('mt_jabatan','mt_pegawai.jabatan','mt_jabatan.id_jab')
            ->join('t_penerima','mt_pegawai.id_p','t_penerima.id_p')
            ->where('mt_pegawai.kdkunker', $unker)
            ->where('t_penerima.id_periode', $periode)
            ->where('t_penerima.proses', 'Y')
            ->where('t_penerima.status', '3')
            ->get();
        return view('data.dataPenerima3',['data' => $data]);
    }

    function AccUsulan($id) {
        $data = DB::table('t_penerima')
            ->where("id_penerima", $id)
            ->update([
                'proses'    => 'Y',
                'status'    => '2',
            ]);
        Session::flash('alertSuccess', 'Berhasil menyetujui usulan');
        return Redirect::to(route('panel.penerima.penghargaan'));
    }

    function TolakUsulan(Request $request) {
        $data = DB::table('t_penerima')
            ->where("id_penerima", $request->id)
            ->update([
                'proses'    => 'Y',
                'status'    => '3',
                'alasan'    => $request->alasan,
            ]);
        Session::flash('alertSuccess', 'Berhasil menolak usulan');
        return Redirect::to(route('panel.penerima.penghargaan'));
    }







    function users() {
        $data = DB::table('mt_unit_kerja')->orderBy('unker','asc')->get();

        return view('panel.users',['data' => $data]);
    }
    function indexsyarat() {
        return view('panel.filesyarat');
    }

    function usersInsert() {

        $unker = Input::get('unker');
        $nama = Input::get('nama');
        $email = Input::get('email');
        $username = Input::get('username');
        $role_id = Input::get('role');
        $password = bcrypt($username);

        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ];

        $cek = DB::table('users')
            ->where('username', '=', $username)
            ->count();

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return false;
        } else {

            if ($cek != 1) {
                $user = new User();
                $user->name = $nama;
                $user->email = $email;
                $user->lastlogin = date('Y-m-d H:i:s');
                $user->username = $username;
                $user->password = $password;
                $user->id_unker = $unker;
                $user->save();
                $role_id = Input::get('role');
                $role = Role::where('id', '=', $role_id)
                            ->first();
                $user->attachRole($role);
                Session::flash('alertSuccess', 'Berhasil Menambah User');
                return Redirect::to(route('panel.users'));
            } else {
                return false;
            }
            
        }
    }

    function usersEdit() {
        $id = Input::get('id');
        $nama = Input::get('nama');
        $email = Input::get('email');
        $username = Input::get('username');
        $unker = Input::get('unker');
        $role = Input::get('role');

        $rules = [
            'username' => 'required',
            'email' => 'required|email',
        ];

        $validator = Validator::make(Input::all(), $rules);

        $cek = DB::table('users')
            ->where('username', '=', $username)
            ->where('id', '!=', $id)
            ->count();

        if ($validator->fails()) {
            return false;
        } else {

            if ($cek != 1) {
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['email' => $email, 'username' => $username, 'name' => $nama, 'id_unker' => $unker]);

                Session::flash('alertSuccess', 'Berhasil Mengupdate User');
                return Redirect::to(route('panel.users'));
            }else{
                Session::flash('alertGagal', 'Username telah digunakan');
                return Redirect::to(route('panel.users'));
            }
        }
    }

    function usersDelete($id) {
        DB::table('users')
            ->where('id', '=', $id)
            ->delete();

        DB::table('role_user')
            ->where('user_id', '=', $id)
            ->delete();

        Session::flash('alertSuccess', 'Berhasil menghapus user.');
        return Redirect::to(route('panel.users'));
    }

    function usersAktif($id) {

        $users = DB::table('users')
                    ->select('aktif')
                    ->where('id', '=', $id)
                    ->first();
        
        if($users->aktif == 1){
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['aktif' => '0']);
        }else{
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['aktif' => '1']);
        }

        return null;
    }

    function usersReset($id) {
        $users = DB::table('users')
                    ->select('name', 'username')
                    ->where('id', '=', $id)
                    ->first();

        DB::table('users')
            ->where('id', '=', $id)
            ->update(['password' => bcrypt($users->username)]);

        return null;
    }

    function usersJson() {
        $data = DB::table('users')
                    ->join('role_user', 'user_id', '=', 'users.id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->join('mt_unit_kerja', 'users.id_unker', '=', 'mt_unit_kerja.id_unker')
                    ->select('users.id', 'users.name', 'users.username', 'users.lastlogin', 'email', 'roles.display_name', 'roles.color', 'users.created_at', 'users.aktif','mt_unit_kerja.unker as unkers')
                    ->orderBy('created_at', 'asc');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($data)  {
                return '    <span><strong>'.$data->name.'</strong></span>
                            <br/>
                            <span>'.$data->email.'</span>';
            })
            ->editColumn('opd', function ($data)  {
                return '    <span>'.$data->unkers.'</span>';
            })
            ->editColumn('display_name', function ($data)  {
                return '    <span class="label label-'.$data->color.'">'.$data->display_name.'</span>';
            })
            ->editColumn('created_at', function ($data)  {
                return '    <span>'.Carbon::parse($data->lastlogin)->format('d F Y, H:i:s').'</span>';
            })
            ->editColumn('aksi', function ($data)  {
                if($data->aktif == 1){
                    $toggle = 'on';
                    $color = 'success';
                }else{
                    $toggle = 'off';
                    $color = 'primary';
                }
                return '    <div class="tooltip-demo">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" 
                                    onclick="ResetPass(&quot;'.$data->id.'&quot;)" 
                                    title="Tooltip on left">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-close"></i></button>
                                <button class="btn btn-sm btn-'.$color.'" onclick="aktif(&quot;'.$data->id.'&quot;)"><i class="fa fa-toggle-'.$toggle.'"></i></button>
                            </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function usersJsonEdit($id) {
        $data = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->select('users.id', 'users.name', 'username', 'email', 'role_user.role_id', 'users.id_unker')
                    ->where('users.id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email,
            'role' => $data->role_id,
            'unker' => $data->id_unker
        );

        echo json_encode($data);
    }

    function akun() {
        return view('panel.akun');
    }

    function akunEditPassword(Request $request) {
        $username = Auth::user()->username;
    	$password = Auth::user()->password;
    	$password_sekarang = Input::get('passwordSekarang');
		$password_baru = Input::get('passwordBaru');
		$ulangi_password_baru = Input::get('ulangiPasswordBaru');

		$rules = [
			'passwordSekarang' => 'required',
			'passwordBaru' => 'required|min:6',
			'ulangiPasswordBaru' => 'required|same:passwordBaru',
		];

		$message = [
			'passwordBaru.min' => 'Password tidak boleh kurang dari :min',
            'ulangiPasswordBaru.same' => 'Kolom Password Baru dan Ulangi password baru harus sama.',
		];

		$validator = Validator::make(Input::all(), $rules, $message);

		if ($validator->fails()) {
			return Redirect::to(route('panel.akun'))->withErrors($validator)->withInput();
		} else {
			if (!(Hash::check($request->get('passwordSekarang'), Auth::user()->password))) {
				Session::flash('alertSalahPassword', 'Password sekarang salah.');
				return Redirect::to(route('panel.akun'));
			} else {
				DB::table('users')
				->where('username', '=', $username)
				->update(['password'=>bcrypt($password_baru)]);

				Session::flash('alertSuccess', 'Berhasil mengganti password.');
				return Redirect::to(route('panel.akun'));
			}
    	}
    }

    function status() {
        return view('panel.status');
    }



}