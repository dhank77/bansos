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

    function IndexAduan() {
        $data = DB::table('ms_kab')
                ->select('id','kd_kab','nama_kab')
                ->get();

        return view('panel.aduan', [ 'data' => $data ]);
    }

    function AduanJSON($kab, $kec, $kel) {

        if($kab == '00') {
            $data = DB::table('aduan')
                ->selectRaw("id,nik,nama,no_tlp,no_wa,alamat,email,rt,rw,pekerjaan,penghasilan_sebelum,penghasilan_setelah,jum_keluarga,foto_ktp,foto_kepalakeluarga,
                        (SELECT nama_kab FROM ms_kab WHERE kd_kab = aduan.kd_kabkot) as nama_kab,
                        (SELECT nama_kec FROM ms_kec WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec) as nama_kec,
                        (SELECT nama_kel FROM ms_kel WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec and kd_kel = aduan.kd_kel ) as nama_kel,
                        (SELECT status_kedudukan FROM ms_status_kedudukan WHERE id = aduan.id_status_kedudukan ) as status_kedudukan,
                        (SELECT jenis_laporan FROM ms_jenis_laporan WHERE id = aduan.id_jenis_laporan ) as jenis_laporan,
                        (SELECT kategori FROM ms_kategori WHERE id = aduan.id_kategori ) as kategori,
                        (SELECT jenis FROM ms_jenis WHERE id = aduan.id_jenis ) as jenis
                        ")
                ->orderBy('id','asc');
        }else{

            if($kec == '00'){
                $data = DB::table('aduan')
                    ->selectRaw("id,nik,nama,no_tlp,no_wa,alamat,email,rt,rw,pekerjaan,penghasilan_sebelum,penghasilan_setelah,jum_keluarga,foto_ktp,foto_kepalakeluarga,
                            (SELECT nama_kab FROM ms_kab WHERE kd_kab = aduan.kd_kabkot) as nama_kab,
                            (SELECT nama_kec FROM ms_kec WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec) as nama_kec,
                            (SELECT nama_kel FROM ms_kel WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec and kd_kel = aduan.kd_kel ) as nama_kel,
                            (SELECT status_kedudukan FROM ms_status_kedudukan WHERE id = aduan.id_status_kedudukan ) as status_kedudukan,
                            (SELECT jenis_laporan FROM ms_jenis_laporan WHERE id = aduan.id_jenis_laporan ) as jenis_laporan,
                            (SELECT kategori FROM ms_kategori WHERE id = aduan.id_kategori ) as kategori,
                            (SELECT jenis FROM ms_jenis WHERE id = aduan.id_jenis ) as jenis
                            ")
                    ->where('aduan.kd_kabkot',$kab)
                    ->orderBy('id','asc');
            }else{
                if($kel == '00'){
                    $data = DB::table('aduan')
                        ->selectRaw("id,nik,nama,no_tlp,no_wa,alamat,email,rt,rw,pekerjaan,penghasilan_sebelum,penghasilan_setelah,jum_keluarga,foto_ktp,foto_kepalakeluarga,
                                (SELECT nama_kab FROM ms_kab WHERE kd_kab = aduan.kd_kabkot) as nama_kab,
                                (SELECT nama_kec FROM ms_kec WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec) as nama_kec,
                                (SELECT nama_kel FROM ms_kel WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec and kd_kel = aduan.kd_kel ) as nama_kel,
                                (SELECT status_kedudukan FROM ms_status_kedudukan WHERE id = aduan.id_status_kedudukan ) as status_kedudukan,
                                (SELECT jenis_laporan FROM ms_jenis_laporan WHERE id = aduan.id_jenis_laporan ) as jenis_laporan,
                                (SELECT kategori FROM ms_kategori WHERE id = aduan.id_kategori ) as kategori,
                                (SELECT jenis FROM ms_jenis WHERE id = aduan.id_jenis ) as jenis
                                ")
                        ->where('aduan.kd_kabkot',$kab)
                        ->where('aduan.kd_kec',$kec)
                        ->orderBy('id','asc');
                } else {
                    $data = DB::table('aduan')
                        ->selectRaw("id,nik,nama,no_tlp,no_wa,alamat,email,rt,rw,pekerjaan,penghasilan_sebelum,penghasilan_setelah,jum_keluarga,foto_ktp,foto_kepalakeluarga,
                                (SELECT nama_kab FROM ms_kab WHERE kd_kab = aduan.kd_kabkot) as nama_kab,
                                (SELECT nama_kec FROM ms_kec WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec) as nama_kec,
                                (SELECT nama_kel FROM ms_kel WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec and kd_kel = aduan.kd_kel ) as nama_kel,
                                (SELECT status_kedudukan FROM ms_status_kedudukan WHERE id = aduan.id_status_kedudukan ) as status_kedudukan,
                                (SELECT jenis_laporan FROM ms_jenis_laporan WHERE id = aduan.id_jenis_laporan ) as jenis_laporan,
                                (SELECT kategori FROM ms_kategori WHERE id = aduan.id_kategori ) as kategori,
                                (SELECT jenis FROM ms_jenis WHERE id = aduan.id_jenis ) as jenis
                                ")
                        ->where('aduan.kd_kabkot',$kab)
                        ->where('aduan.kd_kec',$kec)
                        ->where('aduan.kd_kel',$kel)
                        ->orderBy('id','asc');
                }
            }
        }

        // $data = DB::table('aduan')
        //     ->selectRaw("id,nik,nama,no_tlp,no_wa,alamat,email,rt,rw,pekerjaan,penghasilan_sebelum,penghasilan_setelah,jum_keluarga,foto_ktp,foto_kepalakeluarga,
        //             (SELECT nama_kab FROM ms_kab WHERE kd_kab = aduan.kd_kabkot) as nama_kab,
        //             (SELECT nama_kec FROM ms_kec WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec) as nama_kec,
        //             (SELECT nama_kel FROM ms_kel WHERE kd_kab = aduan.kd_kabkot and kd_kec = aduan.kd_kec and kd_kel = aduan.kd_kel ) as nama_kel,
        //             (SELECT status_kedudukan FROM ms_status_kedudukan WHERE id = aduan.id_status_kedudukan ) as status_kedudukan,
        //             (SELECT jenis_laporan FROM ms_jenis_laporan WHERE id = aduan.id_jenis_laporan ) as jenis_laporan,
        //             (SELECT kategori FROM ms_kategori WHERE id = aduan.id_kategori ) as kategori,
        //             (SELECT jenis FROM ms_jenis WHERE id = aduan.id_jenis ) as jenis
        //             ")
        //     ->orderBy('id','asc');
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('nik', function ($data)  {
                return '    <p>'.$data->nik.'</p>';
            })
            ->editColumn('nama', function ($data)  {
                return '    <p>'.$data->nama.'</p>';
            })
            ->editColumn('email', function ($data)  {
                return '    <p>'.$data->email.'</p>';
            })
            ->editColumn('no_tlp', function ($data)  {
                return '    <p>'.$data->no_tlp.'</p>';
            })
            ->editColumn('no_wa', function ($data)  {
                return '    <p>'.$data->no_wa.'</p>';
            })
            ->editColumn('alamat', function ($data)  {
                return '    <p>'.$data->alamat.'</p>';
            })
            ->editColumn('kd_kab', function ($data)  {
                return '    <p>'.$data->nama_kab.'</p>';
            })
            ->editColumn('kd_kec', function ($data)  {
                return '    <p>'.$data->nama_kec.'</p>';
            })
            ->editColumn('kd_kel', function ($data)  {
                return '    <p>'.$data->nama_kel.'</p>';
            })
            ->editColumn('rt', function ($data)  {
                return '    <p>'.$data->rt.'</p>';
            })
            ->editColumn('rw', function ($data)  {
                return '    <p>'.$data->rw.'</p>';
            })
            ->editColumn('pekerjaan', function ($data)  {
                return '    <p>'.$data->pekerjaan.'</p>';
            })
            ->editColumn('id_status_kedudukan', function ($data)  {
                return '    <p>'.$data->status_kedudukan.'</p>';
            })
            ->editColumn('penghasilan_sebelum', function ($data)  {
                return '    <p>'.$data->penghasilan_sebelum.'</p>';
            })
            ->editColumn('penghasilan_setelah', function ($data)  {
                return '    <p>'.$data->penghasilan_setelah.'</p>';
            })
            ->editColumn('jum_keluarga', function ($data)  {
                return '    <p>'.$data->jum_keluarga.'</p>';
            })
            ->editColumn('id_jenis_laporan', function ($data)  {
                return '    <p>'.$data->jenis_laporan.'</p>';
            })
            ->editColumn('id_kategori', function ($data)  {
                return '    <p>'.$data->kategori.'</p>';
            })
            ->editColumn('id_jenis', function ($data)  {
                return '    <p>'.$data->jenis.'</p>';
            })
            ->editColumn('foto_ktp', function ($data)  {
                return '    <p>'.$data->foto_ktp.'</p>';
            })
            ->editColumn('foto_kepalakeluarga', function ($data)  {
                return '    <p>'.$data->foto_kepalakeluarga.'</p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function IndexPemberiBantuan() {
        return view('panel.pemberiBantuan');
    }

    function PemberiBantuanJSON() {
        $data = DB::table('t_pemberi_bantuan')
                ->select('id','pemberi_bantuan','jenis_bantuan','jumlah','total_bantuan','tanggal_masuk','keterangan')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('pemberi_bantuan', function ($data)  {
                return '    <p>'.$data->pemberi_bantuan.'</p>';
            })
            ->editColumn('jenis_bantuan', function ($data)  {
                return '    <p>'.$data->jenis_bantuan.'</p>';
            })
            ->editColumn('jumlah', function ($data)  {
                return '    <p>'.$data->jumlah.'</p>';
            })
            ->editColumn('total_bantuan', function ($data)  {
                return '    <p>'.$data->total_bantuan.'</p>';
            })
            ->editColumn('tanggal_masuk', function ($data)  {
                return '    <p>'.$data->tanggal_masuk.'</p>';
            })
            ->editColumn('keterangan', function ($data)  {
                return '    <p>'.$data->keterangan.'</p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData( &quot;'.$data->id.'&quot; )"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function PemberiBantuanInsert(Request $request) {
        $validator = Validator::make(request()->all(), [ ]);
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('t_pemberi_bantuan')
                    ->insert([
                        'pemberi_bantuan'   => $request->pemberi_bantuan,
                        'jenis_bantuan'     => $request->jenis_bantuan,
                        'jumlah'            => $request->jumlah,
                        'total_bantuan'     => $request->total_bantuan,
                        'tanggal_masuk'     => $request->tanggal_masuk,
                        'keterangan'        => $request->keterangan
                    ]);
            return null;
        }
    }

    function PemberiBantuanEditJSON($id) {
        $data = DB::table('t_pemberi_bantuan')
                ->where('id','=', $id)
                ->get();
        return $data;
    }

    function PemberiBantuanDelete($id) {
        DB::table('t_pemberi_bantuan')
                ->where('id','=', $id)
                ->delete();
        return null;
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
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
		$file = $request->file('file');
		$nama_file = rand().$file->getClientOriginalName();
		$file->move('file_penerima',$nama_file);
		Excel::import(new PenerimaImport, public_path('file_penerima/'.$nama_file));
		return redirect('/panel');
    }
    





    

    function users() {
        return view('panel.users');
    }

    function usersInsert() {

        $unker = '-';
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
        $unker = '-';
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
                    ->select('users.id', 'users.name', 'users.username', 'users.lastlogin', 'email', 'roles.display_name', 'roles.color', 'users.created_at', 'users.aktif')
                    ->orderBy('created_at', 'asc');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($data)  {
                return '    <span><strong>'.$data->name.'</strong></span>
                            <br/>
                            <span>'.$data->email.'</span>';
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

}