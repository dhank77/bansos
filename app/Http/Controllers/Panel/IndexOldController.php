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

class IndexController extends Controller {
    function index() {
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->update(['lastlogin' => date('Y-m-d H:i:s') ]);

        return view('panel.dashboard');
    }

    function PageLaporan() {

        $data = DB::table('users')
                ->join('role_user', 'user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->select('users.id', 'users.name', 'users.username', 'users.lastlogin', 'email', 'roles.display_name', 'roles.color', 'users.created_at')
                ->where('roles.name', '!=', 'superadmin')
                ->where('roles.name', '!=', 'admin')
                ->get();

        return view('panel.pagelaporan', ['data' => $data]);
    }

    function MasterSkpd() {
        return view('panel.master_skpd');
    }

    function MasterSkpdInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'KodeSkpd'      => 'required',
            'NamaSkpd'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_skpd_provinsi')
                    ->insert([
                        'kode_skpd'       => $request->KodeSkpd,
                        'nama_skpd'        => $request->NamaSkpd,
                    ]);
            return null;
        }
    }

    function MasterSkpdEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'KodeSkpd'      => 'required',
            'NamaSkpd'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_skpd_provinsi')
                    ->where('id',$request->id)
                    ->update([
                        'kode_skpd'       => $request->KodeSkpd,
                        'nama_skpd'        => $request->NamaSkpd,
                    ]);
            return null;
        }
    }

    function MasterSkpdDelete($id) {
            DB::table('ms_skpd_provinsi')
                    ->where('id','=', $id)
                    ->delete();
            return null;
    }


    function MasterSkpdJSON() {
        $data = DB::table('ms_skpd_provinsi')
                ->select('id','kode_skpd','nama_skpd')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('kode_skpd', function ($data)  {
                return '    <p>'.$data->kode_skpd.'</p>';
            })
            ->editColumn('nama_skpd', function ($data)  {
                return '    <p><strong>'.$data->nama_skpd.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->kode_skpd.'&quot;,&quot;'.$data->nama_skpd.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MasterSkpdKab() {
        return view('panel.master_skpd_kab');
    }

    function MasterSkpdKabInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'KodeSkpd'      => 'required',
            'NamaSkpd'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_daerah')
                    ->insert([
                        'kode_skpd'       => $request->KodeSkpd,
                        'nama_skpd'        => $request->NamaSkpd,
                    ]);
            return null;
        }
    }

    function MasterSkpdKabEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'KodeSkpd'      => 'required',
            'NamaSkpd'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_daerah')
                    ->where('id',$request->id)
                    ->update([
                        'kode_skpd'       => $request->KodeSkpd,
                        'nama_skpd'        => $request->NamaSkpd,
                    ]);
            return null;
        }
    }

    function MasterSkpdKabDelete($id) {
            DB::table('ms_daerah')
                    ->where('id','=', $id)
                    ->delete();
            return null;
    }


    function MasterSkpdKabJSON() {
        $data = DB::table('ms_daerah')
                ->select('id','kode_skpd','nama_skpd')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('kode_skpd', function ($data)  {
                return '    <p>'.$data->kode_skpd.'</p>';
            })
            ->editColumn('nama_skpd', function ($data)  {
                return '    <p><strong>'.$data->nama_skpd.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->kode_skpd.'&quot;,&quot;'.$data->nama_skpd.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MasterBelanja() {
        return view('panel.master_jenis_belanja');
    }

    function MasterBelanjaInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Nama'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_belanja')
                    ->insert([
                        'nama'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MasterBelanjaEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_belanja')
                    ->where('id',$request->id)
                    ->update([
                        'nama'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MasterBelanjaDelete($id) {
            DB::table('ms_belanja')
                    ->where('id','=', $id)
                    ->delete();
            return null;
    }


    function MasterBelanjaJSON() {
        $data = DB::table('ms_belanja')
                ->select('id','nama')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data)  {
                return '    <p><strong>'.$data->nama.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->nama.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MasterKodefikasi() {
        return view('panel.master_kodefikasi');
    }

    function MasterKodefikasiInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Nama'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_kodefikasi')
                    ->insert([
                        'nama'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MasterKodefikasiEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('ms_kodefikasi')
                    ->where('id',$request->id)
                    ->update([
                        'nama'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MasterKodefikasiDelete($id) {
            DB::table('ms_kodefikasi')
                    ->where('id','=', $id)
                    ->delete();
            return null;
    }


    function MasterKodefikasiJSON() {
        $data = DB::table('ms_kodefikasi')
                ->select('id','nama')
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data)  {
                return '    <p><strong>'.$data->nama.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->nama.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }


   

    function MsProgram() {
        return view('panel.ms_program');
    }

    function MsProgramJSON() {
        $data = DB::table('program')
                ->select('id','kodeprogram','namaprogram')
                ->where('id_skpd', Auth::user()->id)
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('kode', function ($data)  {
                return '    <p><strong>'.$data->kodeprogram.'</strong></p>';
            })
            ->editColumn('nama', function ($data)  {
                return '    <p><strong>'.$data->namaprogram.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->namaprogram.'&quot;,&quot;'.$data->kodeprogram.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MsProgramInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Kode'      => 'required',
            'Nama'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('program')
                    ->insert([
                        'kodeprogram'        => $request->Kode,
                        'namaprogram'        => $request->Nama,
                        'kodeskpd'        => Auth::user()->id
                    ]);
            return null;
        }
    }

    function MsProgramEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Kode'          => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('program')
                    ->where('id',$request->id)
                    ->update([
                        'namaprogram'        => $request->Nama,
                        'kodeprogram'        => $request->Kode,
                    ]);
            return null;
        }
    }

    function MsProgramDelete($id) {
        DB::table('program')
                ->where('id','=', $id)
                ->delete();
        return null;
    }






    function MsKegiatan() {
        return view('panel.ms_kegiatan');
    }

    function LoadDataProgram() {
        $data = DB::table('program')
        ->select('id','namaprogram')
        ->where('kodeskpd', Auth::user()->id)
        ->get();

        return view('data.data_ms_program', ['data' => $data]);
    }

    function MsKegiatanJSON() {
        $data = DB::table('kegiatan')
                ->join('program','kegiatan.id_program','program.id')
                ->select('kegiatan.id','kegiatan.kodekegiatan','kegiatan.namakegiatan','program.kodeprogram','program.namaprogram')
                ->where('kegiatan.id_skpd', Auth::user()->id)
                ->orderBy('kegiatan.id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('kodeprogram', function ($data)  {
                return '<p>'.$data->namaprogram.'</p>';
            })
            ->editColumn('kodekegiatan', function ($data)  {
                return '    <p><strong>'.$data->kodekegiatan.'</strong></p>';
            })
            ->editColumn('namakegiatan', function ($data)  {
                return '    <p><strong>'.$data->namakegiatan.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->kodeprogram.'&quot;,&quot;'.$data->namakegiatan.'&quot;,&quot;'.$data->namakegiatan.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MsKegiatanInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'KodeProgram'      => 'required',
            'KodeKegiatan'      => 'required',
            'Nama'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {

            $cek = DB::table('kegiatan')
            ->where('kodekegiatan', '=', $request->KodeKegiatan)
            ->where('kodeskpd', '=', Auth::user()->id)
            ->count();

            $program = DB::table('program')
                ->select('id','kodeprogram','namaprogram')
                ->where('id', '=', $request->KodeProgram)
                ->first();

            if ($cek != 1) {
                DB::table('kegiatan')
                ->insert([
                    'id_program'        => $program->id,
                    'kodeprogram'        => $program->kodeprogram,
                    'kodekegiatan'        => $request->KodeKegiatan,
                    'namakegiatan'        => $request->Nama,
                    'kodeskpd'        => Auth::user()->id
                ]);
                return null;
            }else{
                return false;
            }
        }
    }

    function MsKegiatanEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('kegiatan')
                    ->where('id',$request->id)
                    ->update([
                        'namakegiatan'        => $request->Nama
                    ]);
            return null;
        }
    }

    function MsKegiatanDelete($id) {
        DB::table('kegiatan')
                ->where('id','=', $id)
                ->delete();
        return null;
    }

    function MsBidang() {
        return view('panel.ms_bidang');
    }

    function MsBidangJSON() {
        $data = DB::table('bidang')
                ->select('id','namabidang')
                ->where('kodeskpd', Auth::user()->id)
                ->orderBy('id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('nama', function ($data)  {
                return '    <p><strong>'.$data->namabidang.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->namabidang.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MsBidangInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Nama'      => 'required'
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('bidang')
                    ->insert([
                        'namabidang'        => $request->Nama,
                        'kodeskpd'        => Auth::user()->id,
                        'kodedaerah'        => Auth::user()->id_skpd
                    ]);
            return null;
        }
    }

    function MsBidangEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('bidang')
                    ->where('id',$request->id)
                    ->update([
                        'namabidang'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MsBidangDelete($id) {
        DB::table('bidang')
                ->where('id','=', $id)
                ->delete();
        return null;
    }

    function MsSubBidang() {
        return view('panel.ms_subbidang');
    }

    function LoadDataBidang() {
        $data = DB::table('bidang')
        ->select('id','namabidang')
        ->where('kodeskpd', Auth::user()->id)
        ->get();

        return view('data.data_ms_bidang', ['data' => $data]);
    }

    function MsSubBidangJSON() {
        $data = DB::table('subbidang')
                ->join('bidang','subbidang.id_bidang','bidang.id')
                ->select('subbidang.id','subbidang.namasubbidang','bidang.namabidang')
                ->where('subbidang.kodeskpd', Auth::user()->id)
                ->orderBy('subbidang.id','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('namab', function ($data)  {
                return '    <p><strong>'.$data->namabidang.'</strong></p>';
            })
            ->editColumn('namas', function ($data)  {
                return '    <p><strong>'.$data->namasubbidang.'</strong></p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->namasubbidang.'&quot;)"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->id.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function MsSubBidangInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'Bidang'      => 'required',
            'Nama'      => 'required'
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('subbidang')
                    ->insert([
                        'id_bidang'        => $request->Bidang,
                        'namasubbidang'        => $request->Nama,
                        'kodeskpd'        => Auth::user()->id,
                        'kodedaerah'        => Auth::user()->id_skpd
                    ]);
            return null;
        }
    }

    function MsSubBidangEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'id'            => 'required',
            'Nama'          => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            DB::table('subbidang')
                    ->where('id',$request->id)
                    ->update([
                        'namasubbidang'        => $request->Nama,
                    ]);
            return null;
        }
    }

    function MsSubBidangDelete($id) {
        DB::table('subbidang')
                ->where('id','=', $id)
                ->delete();
        return null;
    }

    function Program() {
        return view('panel.data_program');
    }

    function DataProgramInsert(Request $request) {
        $validator = Validator::make(request()->all(), [
            'JenisDak'      => 'required',
            'Triwulan'      => 'required',
            'Tahun'      => 'required',
            'Bidang'      => 'required',
            'SubBidang'      => 'required',
            'Program'      => 'required',
            'NamaKegiatan'      => 'required',
            'RinciKegiatan'      => 'required',
            'Volume'      => 'required',
            'Satuan'      => 'required',
            'JumlahPManfaat'      => 'required',
            'PaguDakFisik'      => 'required',
            'VolumeSwakelola'      => 'required',
            'VolumeSwakelolaRP'      => 'required',
            'VolumeKontraktual'      => 'required',
            'VolumeKontraktualRP'      => 'required',
            'MetodePembayaran'      => 'required',
            'Keuangan'      => 'required',
            'KeuanganPersen'      => 'required',
            'FisikVol'      => 'required',
            'FisikPersen'      => 'required',
            'Kodefikasi'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            if ($request->SubReguler != null) {
                $subjenisdak = $request->SubReguler;
            } else {
                $subjenisdak = '0';
            }

            if ($request->SubRegulerII != null) {
                $subjenisdakii = $request->SubRegulerII;
            } else {
                $subjenisdakii = '0';
            }
            DB::table('data_program')
                    ->insert([
                        'jenisdak'        => $request->JenisDak,
                        'subjenisdak'        => $subjenisdak,
                        'subsubjenisdak'        => $subjenisdakii,
                        'tahun'        => $request->Tahun,
                        'triwulan'        => $request->Triwulan,
                        'bidang'        => $request->Bidang,
                        'subbidang'        => $request->SubBidang,
                        'program'        => $request->Program,
                        'namakegiatan'        => $request->NamaKegiatan,
                        'rincikegiatan'        => $request->RinciKegiatan,
                        'volume'        => $request->Volume,
                        'satuan'        => $request->Satuan,
                        'jumlahpmanfaat'        => $request->JumlahPManfaat,
                        'pagudakfisik'        => $request->PaguDakFisik,
                        'swakelolavol'        => $request->VolumeSwakelola,
                        'swakelolanilai'        => $request->VolumeSwakelolaRP,
                        'kontraktualvol'        => $request->VolumeKontraktual,
                        'kontraktualnilai'        => $request->VolumeKontraktualRP,
                        'metodepembayaran'        => $request->MetodePembayaran,
                        'keuangan'        => $request->Keuangan,
                        'keuanganpersen'        => $request->KeuanganPersen,
                        'fisikvol'        => $request->FisikVol,
                        'fisikpersen'        => $request->FisikPersen,
                        'kodefikasimasalah'        => $request->Kodefikasi,
                        'kodeskpd'        => Auth::user()->id,
                    ]);
            return null;
        }
    }

    function DataProgramEdit(Request $request) {
        $validator = Validator::make(request()->all(), [
            'JenisDak'      => 'required',
            'Tahun'      => 'required',
            'Triwulan'      => 'required',
            'Bidang'      => 'required',
            'SubBidang'      => 'required',
            'Program'      => 'required',
            'NamaKegiatan'      => 'required',
            'RinciKegiatan'      => 'required',
            'Volume'      => 'required',
            'Satuan'      => 'required',
            'JumlahPManfaat'      => 'required',
            'PaguDakFisik'      => 'required',
            'VolumeSwakelola'      => 'required',
            'VolumeSwakelolaRP'      => 'required',
            'VolumeKontraktual'      => 'required',
            'VolumeKontraktualRP'      => 'required',
            'MetodePembayaran'      => 'required',
            'Keuangan'      => 'required',
            'KeuanganPersen'      => 'required',
            'FisikVol'      => 'required',
            'FisikPersen'      => 'required',
            'Kodefikasi'      => 'required',
        ]);
        
        if ($validator->fails()) {
             return false;
        } else {
            if ($request->SubReguler != null) {
                $subjenisdak = $request->SubReguler;
            } else {
                $subjenisdak = '0';
            }

            if ($request->SubRegulerII != null) {
                $subjenisdakii = $request->SubRegulerII;
            } else {
                $subjenisdakii = '0';
            }
            DB::table('data_program')
                    ->where('id', $request->id)
                    ->update([
                        'jenisdak'        => $request->JenisDak,
                        'subjenisdak'        => $subjenisdak,
                        'subsubjenisdak'        => $subjenisdakii,
                        'tahun'        => $request->Tahun,
                        'triwulan'        => $request->Triwulan,
                        'bidang'        => $request->Bidang,
                        'subbidang'        => $request->SubBidang,
                        'program'        => $request->Program,
                        'namakegiatan'        => $request->NamaKegiatan,
                        'rincikegiatan'        => $request->RinciKegiatan,
                        'volume'        => $request->Volume,
                        'satuan'        => $request->Satuan,
                        'jumlahpmanfaat'        => $request->JumlahPManfaat,
                        'pagudakfisik'        => $request->PaguDakFisik,
                        'swakelolavol'        => $request->VolumeSwakelola,
                        'swakelolanilai'        => $request->VolumeSwakelolaRP,
                        'kontraktualvol'        => $request->VolumeKontraktual,
                        'kontraktualnilai'        => $request->VolumeKontraktualRP,
                        'metodepembayaran'        => $request->MetodePembayaran,
                        'keuangan'        => $request->Keuangan,
                        'keuanganpersen'        => $request->KeuanganPersen,
                        'fisikvol'        => $request->FisikVol,
                        'fisikpersen'        => $request->FisikPersen,
                        'kodefikasimasalah'        => $request->Kodefikasi,
                        'kodeskpd'        => Auth::user()->id,
                    ]);
            return null;
        }
    }

    function DataProgramJSON() {
        $data = DB::table('data_program')
                ->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
                ->join('bidang','data_program.bidang','bidang.id')
                ->join('subbidang','data_program.subbidang','subbidang.id')
                ->join('program','data_program.program','program.id')
                ->join('kegiatan','data_program.namakegiatan','kegiatan.id')
                ->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
                ->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
                ->select( 'data_program.*','data_program.id as dataid','ms_belanja.nama as namajenisdak','program.namaprogram','kegiatan.namakegiatan as namakegiatans','ms_metodepembayaran.nama as namametode','ms_kodefikasi.nama','bidang.namabidang as namabidangs','subbidang.namasubbidang as namasubbidangs' )
                ->where('data_program.kodeskpd',Auth::user()->id)
                ->orderBy('dataid','asc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('jenisdak', function ($data)  {
                return '<p>'.$data->namajenisdak.'</p>';
            })
            ->editColumn('bidang', function ($data)  {
                return '<p>'.$data->namabidangs.'</p>';
            })
            ->editColumn('subbidang', function ($data)  {
                return '<p>'.$data->namasubbidangs.'</p>';
            })
            ->editColumn('program', function ($data)  {
                return '<p>'.$data->namaprogram.'</p>';
            })
            ->editColumn('kegiatan', function ($data)  {
                return '<p>'.$data->namakegiatans.'</p>';
            })
            ->editColumn('rinci', function ($data)  {
                return '<p>'.$data->rincikegiatan.'</p>';
            })
            ->editColumn('volume', function ($data)  {
                return '<p>'.$data->volume.'</p>';
            })
            ->editColumn('satuan', function ($data)  {
                return '<p>'.$data->satuan.'</p>';
            })
            ->editColumn('jumlahpmanfaat', function ($data)  {
                return '<p>'.$data->jumlahpmanfaat.'</p>';
            })
            ->editColumn('pagudakfisik', function ($data)  {
                return '<p>'.$data->pagudakfisik.'</p>';
            })
            ->editColumn('swakelolavol', function ($data)  {
                return '<p>'.$data->swakelolavol.'</p>';
            })
            ->editColumn('swakelolanilai', function ($data)  {
                return '<p>'.$data->swakelolanilai.'</p>';
            })
            ->editColumn('kontraktualvol', function ($data)  {
                return '<p>'.$data->kontraktualvol.'</p>';
            })
            ->editColumn('kontraktualnilai', function ($data)  {
                return '<p>'.$data->kontraktualnilai.'</p>';
            })
            ->editColumn('metodepembayaran', function ($data)  {
                return '<p>'.$data->namametode.'</p>';
            })
            ->editColumn('keuangan', function ($data)  {
                return '<p>'.$data->keuangan.'</p>';
            })
            ->editColumn('keuanganpersen', function ($data)  {
                return '<p>'.$data->keuanganpersen.'</p>';
            })
            ->editColumn('fisikvol', function ($data)  {
                return '<p>'.$data->fisikvol.'</p>';
            })
            ->editColumn('fisikpersen', function ($data)  {
                return '<p>'.$data->fisikpersen.'</p>';
            })
            ->editColumn('kodefikasi', function ($data)  {
                return '<p>'.$data->nama.'</p>';
            })
            ->editColumn('tahun', function ($data)  {
                return '<p>'.$data->tahun.'</p>';
            })
            ->editColumn('aksi', function ($data)  {
                return '
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="EditData(
                    
                    &quot;'.$data->dataid.'&quot;,
                    &quot;'.$data->jenisdak.'&quot;,
                    &quot;'.$data->subjenisdak.'&quot;,
                    &quot;'.$data->subsubjenisdak.'&quot;,
                    &quot;'.$data->triwulan.'&quot;,
                    &quot;'.$data->bidang.'&quot;,
                    &quot;'.$data->subbidang.'&quot;,
                    &quot;'.$data->program.'&quot;,
                    &quot;'.$data->namakegiatan.'&quot;,
                    &quot;'.$data->rincikegiatan.'&quot;,
                    &quot;'.$data->volume.'&quot;,
                    &quot;'.$data->satuan.'&quot;,
                    &quot;'.$data->jumlahpmanfaat.'&quot;,
                    &quot;'.$data->pagudakfisik.'&quot;,
                    &quot;'.$data->swakelolavol.'&quot;,
                    &quot;'.$data->swakelolanilai.'&quot;,
                    &quot;'.$data->kontraktualvol.'&quot;,
                    &quot;'.$data->kontraktualnilai.'&quot;,
                    &quot;'.$data->metodepembayaran.'&quot;,
                    &quot;'.$data->keuangan.'&quot;,
                    &quot;'.$data->keuanganpersen.'&quot;,
                    &quot;'.$data->fisikvol.'&quot;,
                    &quot;'.$data->fisikpersen.'&quot;,
                    &quot;'.$data->kodefikasimasalah.'&quot;,
                    &quot;'.$data->tahun.'&quot;
                    
                    
                    )"><i class="fa fa-pencil"></i></button> | 
                <button class="btn btn-sm btn-danger" onclick="HapusData(&quot;'.$data->dataid.'&quot;)"><i class="fa fa-trash"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function DataProgramDelete($id) {
        DB::table('data_program')
                ->where('id','=', $id)
                ->delete();
        return null;
    }

    public function cetakLaporan()
    {
            $tgls = date('d-m-Y');
            $tgl = Carbon::parse($tgls)->format('d F Y');

            $tahundak = '2020';
            $triwulandak = '1';
            $kodeskpd = Auth::user()->id;

            $namafile =  $kodeskpd . $tahundak . $triwulandak . '.' . 'pdf';

            $dakreguler_volume           = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("volume");
            $dakreguler_satuan           = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("satuan");
            $dakreguler_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("jumlahpmanfaat");
            $dakreguler_pagudakfisik     = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("pagudakfisik");
            $dakreguler_swakelolavol     = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolavol");
            $dakreguler_swakelolanilai   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolanilai");
            $dakreguler_kontraktualnilai = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualnilai");
            $dakreguler_kontraktualvol   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualvol");
            $dakreguler_keuangan         = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuangan");
            $dakreguler_keuanganpersen   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuanganpersen");
            $dakreguler_fisikvol         = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikvol");
            $dakreguler_fisikpersen      = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikpersen");

            $dakpenugasan_volume           = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("volume");
            $dakpenugasan_satuan           = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("satuan");
            $dakpenugasan_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("jumlahpmanfaat");
            $dakpenugasan_pagudakfisik     = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("pagudakfisik");
            $dakpenugasan_swakelolavol     = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolavol");
            $dakpenugasan_swakelolanilai   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolanilai");
            $dakpenugasan_kontraktualnilai = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualnilai");
            $dakpenugasan_kontraktualvol   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualvol");
            $dakpenugasan_keuangan         = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuangan");
            $dakpenugasan_keuanganpersen   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuanganpersen");
            $dakpenugasan_fisikvol         = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikvol");
            $dakpenugasan_fisikpersen      = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikpersen");

            $dakaffirmasi_volume           = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("volume");
            $dakaffirmasi_satuan           = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("satuan");
            $dakaffirmasi_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("jumlahpmanfaat");
            $dakaffirmasi_pagudakfisik     = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("pagudakfisik");
            $dakaffirmasi_swakelolavol     = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolavol");
            $dakaffirmasi_swakelolanilai   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("swakelolanilai");
            $dakaffirmasi_kontraktualnilai = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualnilai");
            $dakaffirmasi_kontraktualvol   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("kontraktualvol");
            $dakaffirmasi_keuangan         = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuangan");
            $dakaffirmasi_keuanganpersen   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("keuanganpersen");
            $dakaffirmasi_fisikvol         = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikvol");
            $dakaffirmasi_fisikpersen      = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', Auth::user()->id)->get()->sum("fisikpersen");
        
            $volume           = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("volume");
            $satuan           = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("satuan");
            $jumlahpmanfaat   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("jumlahpmanfaat");
            $pagudakfisik     = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("pagudakfisik");
            $swakelolavol     = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("swakelolavol");
            $swakelolanilai   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("swakelolanilai");
            $kontraktualvol   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("kontraktualvol");
            $kontraktualnilai = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("kontraktualnilai");
            $keuangan         = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("keuangan");
            $keuanganpersen   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("keuanganpersen");
            $fisikvol         = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("fisikvol");
            $fisikpersen      = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', Auth::user()->id)->get()->sum("fisikpersen");
        
        $pdf = PDF::loadview('panel.laporan',[

            'tgl'=>$tgl,
            'tahundak'=>$tahundak, 
            'triwulandak'=>$triwulandak,
            'volume'=>$volume,
            'satuan'=>$satuan,
            'jumlahpmanfaat'=>$jumlahpmanfaat,
            'pagudakfisik'=>$pagudakfisik,
            'swakelolavol'=>$swakelolavol,
            'swakelolanilai'=>$swakelolanilai,
            'kontraktualvol'=>$kontraktualvol,
            'kontraktualnilai'=>$kontraktualnilai,
            'keuangan'=>$keuangan,
            'keuanganpersen'=>$keuanganpersen,
            'fisikvol'=>$fisikvol,
            'fisikpersen'=>$fisikpersen,

            'dakreguler_volume'=>$dakreguler_volume,
            'dakreguler_satuan'=>$dakreguler_satuan,
            'dakreguler_jumlahpmanfaat'=>$dakreguler_jumlahpmanfaat,
            'dakreguler_pagudakfisik'=>$dakreguler_pagudakfisik,
            'dakreguler_swakelolavol'=>$dakreguler_swakelolavol,
            'dakreguler_swakelolanilai'=>$dakreguler_swakelolanilai,
            'dakreguler_kontraktualnilai'=>$dakreguler_kontraktualnilai,
            'dakreguler_kontraktualvol'=>$dakreguler_kontraktualvol,
            'dakreguler_keuangan'=>$dakreguler_keuangan,
            'dakreguler_keuanganpersen'=>$dakreguler_keuanganpersen,
            'dakreguler_fisikvol'=>$dakreguler_fisikvol,
            'dakreguler_fisikpersen'=>$dakreguler_fisikpersen,

            'dakpenugasan_volume'=>$dakpenugasan_volume,
            'dakpenugasan_satuan'=>$dakpenugasan_satuan,
            'dakpenugasan_jumlahpmanfaat'=>$dakpenugasan_jumlahpmanfaat,
            'dakpenugasan_pagudakfisik'=>$dakpenugasan_pagudakfisik,
            'dakpenugasan_swakelolavol'=>$dakpenugasan_swakelolavol,
            'dakpenugasan_swakelolanilai'=>$dakpenugasan_swakelolanilai,
            'dakpenugasan_kontraktualnilai'=>$dakpenugasan_kontraktualnilai,
            'dakpenugasan_kontraktualvol'=>$dakpenugasan_kontraktualvol,
            'dakpenugasan_keuangan'=>$dakpenugasan_keuangan,
            'dakpenugasan_keuanganpersen'=>$dakpenugasan_keuanganpersen,
            'dakpenugasan_fisikvol'=>$dakpenugasan_fisikvol,
            'dakpenugasan_fisikpersen'=>$dakpenugasan_fisikpersen,

            'dakaffirmasi_volume'=>$dakaffirmasi_volume,
            'dakaffirmasi_satuan'=>$dakaffirmasi_satuan,
            'dakaffirmasi_jumlahpmanfaat'=>$dakaffirmasi_jumlahpmanfaat,
            'dakaffirmasi_pagudakfisik'=>$dakaffirmasi_pagudakfisik,
            'dakaffirmasi_swakelolavol'=>$dakaffirmasi_swakelolavol,
            'dakaffirmasi_swakelolanilai'=>$dakaffirmasi_swakelolanilai,
            'dakaffirmasi_kontraktualnilai'=>$dakaffirmasi_kontraktualnilai,
            'dakaffirmasi_kontraktualvol'=>$dakaffirmasi_kontraktualvol,
            'dakaffirmasi_keuangan'=>$dakaffirmasi_keuangan,
            'dakaffirmasi_keuanganpersen'=>$dakaffirmasi_keuanganpersen,
            'dakaffirmasi_fisikvol'=>$dakaffirmasi_fisikvol,
            'dakaffirmasi_fisikpersen'=>$dakaffirmasi_fisikpersen

            
            ])->setPaper('legal', 'landscape');

            $nama =  $kodeskpd . $tahundak . $triwulandak . '.' . 'pdf' ;
            return $pdf->save('filelaporan/' . $nama);

        // return $pdf->stream();
    }

    public function cetakLaporan2($kodeskpd, $tahun, $triwulan)
    {
            $tgls = date('d-m-Y');
            $tgl = Carbon::parse($tgls)->format('d F Y');

            $tahundak = $tahun;
            $triwulandak = $triwulan;
            $kodeskpd = $kodeskpd;

            $namaskpd = DB::table("users")->select('name')->where('id', $kodeskpd)->first()->name;
            $namakepalaskpd = DB::table("users")->select('kepalaopd')->where('id', $kodeskpd)->first()->kepalaopd;
            $nipkepalaskpd = DB::table("users")->select('nip')->where('id', $kodeskpd)->first()->nip;

            if ($triwulan == '1') {
                $triwulanromawi = 'I';
            } else if ($triwulan == '2') {
                $triwulanromawi = 'II';
            } else if ($triwulan == '3') {
                $triwulanromawi = 'III';
            } else if ($triwulan == '4') {
                $triwulanromawi = 'IV';
            }

            $namafile =  $kodeskpd . $tahundak . $triwulandak . '.' . 'pdf';

            $dakreguler_volume           = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
            $dakreguler_satuan           = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
            $dakreguler_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
            $dakreguler_pagudakfisik     = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
            $dakreguler_swakelolavol     = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
            $dakreguler_swakelolanilai   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
            $dakreguler_kontraktualnilai = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
            $dakreguler_kontraktualvol   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
            $dakreguler_keuangan         = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
            $dakreguler_keuanganpersen   = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
            $dakreguler_fisikvol         = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
            $dakreguler_fisikpersen      = DB::table("data_program")->where('jenisdak', '1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");

            $dakpenugasan_volume           = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
            $dakpenugasan_satuan           = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
            $dakpenugasan_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
            $dakpenugasan_pagudakfisik     = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
            $dakpenugasan_swakelolavol     = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
            $dakpenugasan_swakelolanilai   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
            $dakpenugasan_kontraktualnilai = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
            $dakpenugasan_kontraktualvol   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
            $dakpenugasan_keuangan         = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
            $dakpenugasan_keuanganpersen   = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
            $dakpenugasan_fisikvol         = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
            $dakpenugasan_fisikpersen      = DB::table("data_program")->where('jenisdak', '2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");

            $dakaffirmasi_volume           = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
            $dakaffirmasi_satuan           = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
            $dakaffirmasi_jumlahpmanfaat   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
            $dakaffirmasi_pagudakfisik     = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
            $dakaffirmasi_swakelolavol     = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
            $dakaffirmasi_swakelolanilai   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
            $dakaffirmasi_kontraktualnilai = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
            $dakaffirmasi_kontraktualvol   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
            $dakaffirmasi_keuangan         = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
            $dakaffirmasi_keuanganpersen   = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
            $dakaffirmasi_fisikvol         = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
            $dakaffirmasi_fisikpersen      = DB::table("data_program")->where('jenisdak', '3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
        
            $volume           = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("volume");
            $satuan           = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("satuan");
            $jumlahpmanfaat   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
            $pagudakfisik     = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
            $swakelolavol     = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
            $swakelolanilai   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
            $kontraktualvol   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
            $kontraktualnilai = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
            $keuangan         = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("keuangan");
            $keuanganpersen   = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
            $fisikvol         = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("fisikvol");
            $fisikpersen      = DB::table("data_program")->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('data_program.kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
        
        $pdf = PDF::loadview('panel.laporan',[

            'tgl'=>$tgl,
            'tahundak'=>$tahundak, 
            'triwulandak'=>$triwulandak,
            'triwulanromawi'=>$triwulanromawi, 
            'namaskpd'=>$namaskpd, 
            'kodeskpd'=>$kodeskpd, 
            'namakepalaskpd'=>$namakepalaskpd, 
            'nipkepalaskpd'=>$nipkepalaskpd, 
            'volume'=>$volume,
            'satuan'=>$satuan,
            'jumlahpmanfaat'=>$jumlahpmanfaat,
            'pagudakfisik'=>$pagudakfisik,
            'swakelolavol'=>$swakelolavol,
            'swakelolanilai'=>$swakelolanilai,
            'kontraktualvol'=>$kontraktualvol,
            'kontraktualnilai'=>$kontraktualnilai,
            'keuangan'=>$keuangan,
            'keuanganpersen'=>$keuanganpersen,
            'fisikvol'=>$fisikvol,
            'fisikpersen'=>$fisikpersen,

            'dakreguler_volume'=>$dakreguler_volume,
            'dakreguler_satuan'=>$dakreguler_satuan,
            'dakreguler_jumlahpmanfaat'=>$dakreguler_jumlahpmanfaat,
            'dakreguler_pagudakfisik'=>$dakreguler_pagudakfisik,
            'dakreguler_swakelolavol'=>$dakreguler_swakelolavol,
            'dakreguler_swakelolanilai'=>$dakreguler_swakelolanilai,
            'dakreguler_kontraktualnilai'=>$dakreguler_kontraktualnilai,
            'dakreguler_kontraktualvol'=>$dakreguler_kontraktualvol,
            'dakreguler_keuangan'=>$dakreguler_keuangan,
            'dakreguler_keuanganpersen'=>$dakreguler_keuanganpersen,
            'dakreguler_fisikvol'=>$dakreguler_fisikvol,
            'dakreguler_fisikpersen'=>$dakreguler_fisikpersen,

            'dakpenugasan_volume'=>$dakpenugasan_volume,
            'dakpenugasan_satuan'=>$dakpenugasan_satuan,
            'dakpenugasan_jumlahpmanfaat'=>$dakpenugasan_jumlahpmanfaat,
            'dakpenugasan_pagudakfisik'=>$dakpenugasan_pagudakfisik,
            'dakpenugasan_swakelolavol'=>$dakpenugasan_swakelolavol,
            'dakpenugasan_swakelolanilai'=>$dakpenugasan_swakelolanilai,
            'dakpenugasan_kontraktualnilai'=>$dakpenugasan_kontraktualnilai,
            'dakpenugasan_kontraktualvol'=>$dakpenugasan_kontraktualvol,
            'dakpenugasan_keuangan'=>$dakpenugasan_keuangan,
            'dakpenugasan_keuanganpersen'=>$dakpenugasan_keuanganpersen,
            'dakpenugasan_fisikvol'=>$dakpenugasan_fisikvol,
            'dakpenugasan_fisikpersen'=>$dakpenugasan_fisikpersen,

            'dakaffirmasi_volume'=>$dakaffirmasi_volume,
            'dakaffirmasi_satuan'=>$dakaffirmasi_satuan,
            'dakaffirmasi_jumlahpmanfaat'=>$dakaffirmasi_jumlahpmanfaat,
            'dakaffirmasi_pagudakfisik'=>$dakaffirmasi_pagudakfisik,
            'dakaffirmasi_swakelolavol'=>$dakaffirmasi_swakelolavol,
            'dakaffirmasi_swakelolanilai'=>$dakaffirmasi_swakelolanilai,
            'dakaffirmasi_kontraktualnilai'=>$dakaffirmasi_kontraktualnilai,
            'dakaffirmasi_kontraktualvol'=>$dakaffirmasi_kontraktualvol,
            'dakaffirmasi_keuangan'=>$dakaffirmasi_keuangan,
            'dakaffirmasi_keuanganpersen'=>$dakaffirmasi_keuanganpersen,
            'dakaffirmasi_fisikvol'=>$dakaffirmasi_fisikvol,
            'dakaffirmasi_fisikpersen'=>$dakaffirmasi_fisikpersen

            
            ])->setPaper('legal', 'landscape');

            $nama =  $kodeskpd . $tahundak . $triwulandak . '.' . 'pdf' ;
            return $pdf->save('filelaporan/' . $nama);

        // return $pdf->stream();
    }

    function KodefikasiLoad() {
        $data = DB::table('ms_kodefikasi')
        ->select('id','nama')
        ->get();

        return view('data.data_kodefikasi', ['data' => $data]);
    }
    function MetodePembayaranLoad() {
        $data = DB::table('ms_metodepembayaran')
        ->select('id','nama')
        ->get();

        return view('data.data_metodepembayaran', ['data' => $data]);
    }
    function JenisDakLoad() {
        $data = DB::table('ms_belanja')
        ->select('id','nama')
        ->get();

        return view('data.data_jenis_dak', ['data' => $data]);
    }

    function ProgramLoad() {
        $data = DB::table('program')
        ->select('id','kodeprogram','namaprogram')
        ->where('id_skpd', Auth::user()->id)
        ->get();

        return view('data.data_program', ['data' => $data]);
    }

    function KegiatanLoad($id) {
        $kodeprogram = DB::table('program')
        ->select('kodeprogram')
        ->where('id', $id)
        ->first()->kodeprogram;

        $data = DB::table('kegiatan')
        ->select('id','kodekegiatan','namakegiatan')
        ->where('id_skpd', Auth::user()->id)
        ->where('id_program', $id)
        ->get();

        return view('data.data_kegiatan', ['data' => $data]);
    }

    function LoadDataSubBidangID($id) {

        $data = DB::table('subbidang')
        ->select('id','namasubbidang')
        ->where('id_bidang', $id)
        ->where('kodeskpd', Auth::user()->id)
        ->get();

        return view('data.data_ms_subbidang', ['data' => $data]);
    }

    function ProgramEditLoad($program) {
        $data = DB::table('program')
        ->select('id','kodeprogram','namaprogram')
        ->where('id_skpd', Auth::user()->id)
        ->get();

        return view('data.data_program_edit', ['data' => $data, 'program' => $program]);
    }

    function BidangEditLoad($bidang) {
        $data = DB::table('bidang')
        ->select('id','namabidang')
        ->where('kodeskpd', Auth::user()->id)
        ->get();
        return view('data.data_bidang_edit', ['data' => $data, 'bidang' => $bidang]);
    }

    function SubBidangEditLoad($bidang, $subbidang) {

        $data = DB::table('subbidang')
        ->select('id','namasubbidang')
        ->where('kodeskpd', Auth::user()->id)
        ->where('id_bidang', $bidang)
        ->get();

        return view('data.data_subbidang_edit', ['data' => $data, 'subbidang' => $subbidang]);
    }

    function KegiatanEditLoad($program, $kegiatan) {
        $kodeprogram = DB::table('program')
        ->select('kodeprogram')
        ->where('id', $program)
        ->first()->kodeprogram;

        $data = DB::table('kegiatan')
        ->select('id','kodekegiatan','namakegiatan')
        ->where('id_skpd', Auth::user()->id)
        ->where('kodeprogram', $kodeprogram)
        ->get();

        return view('data.data_kegiatan_edit', ['data' => $data, 'kegiatan' => $kegiatan]);
    }

    function loadkab($id) {
        $kab = DB::table('kota_kab')
        ->select('nama_kota','kode_kota')
        ->where('kode_prop', $id)
        ->get();

        return view('panel.data_kab', ['kab' => $kab]);
    }

    function loadinstansi() {
        $data = DB::table('ms_daerah')
            ->select('id','kode_skpd','nama_skpd')
            ->get();

        return view('data.data_instansi', ['data' => $data]);
    }

    function SubRegulerLoad() {
        $data = DB::table('ms_sub_belanja')
            ->select('id','nama')
            ->get();

        return view('data.data_subreguler', ['data' => $data]);
    }

    function SubRegulerIILoad($id) {
        $data = DB::table('ms_sub_belanja_2')
            ->select('id','nama')
            ->where('id_sub_belanja', $id)
            ->get();

        return view('data.data_subregulerii', ['data' => $data]);
    }

    function SubRegulerIIEditLoad($id, $ids) {
        $data = DB::table('ms_sub_belanja_2')
            ->select('id','nama')
            ->where('id_sub_belanja', $id)
            ->get();

        return view('data.data_subregulerii_edit', ['data' => $data, 'ids' => $ids]);
    }

    function Chart($kodeskpd) {
        $pagu1       = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '1')->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik"); 
        $keuangan1   = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '1')->where('kodeskpd', $kodeskpd)->get()->sum("keuangan"); 
        $efisiensi1  = $pagu1 - $keuangan1;

        $pagu2       = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '2')->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik"); 
        $keuangan2   = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '2')->where('kodeskpd', $kodeskpd)->get()->sum("keuangan"); 
        $efisiensi2  = $pagu2 - $keuangan2;

        $pagu3       = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '3')->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik"); 
        $keuangan3   = DB::table("data_program")->where('tahun', '2020')->where('triwulan', '3')->where('kodeskpd', $kodeskpd)->get()->sum("keuangan"); 
        $efisiensi3  = $pagu3 - $keuangan3;
        
        $data = array(
            'pagu1'      => $pagu1,
            'keuangan1'  => $keuangan1,
            'efisiensi1' => $efisiensi1,

            'pagu2'      => $pagu2,
            'keuangan2'  => $keuangan2,
            'efisiensi2' => $efisiensi2,

            'pagu3'      => $pagu3,
            'keuangan3'  => $keuangan3,
            'efisiensi3' => $efisiensi3,
        );

        return $data;
    }





















    function insertskpdnew(){

        $data = DB::table('skpd_new')
            ->select('id','kode','nama')
            ->get();

        foreach ($data as $xdata) {

            DB::table('users')
                ->insert([ 
                    'name' => $xdata->nama, 
                    'username' => $xdata->kode,
                    'email' => $xdata->kode.'@gmail.com',
                    'password' => bcrypt($xdata->kode), 
                    'id_skpd' => '2', 
                    'id_skpd_lama' => $xdata->kode, 
                    ]);
            }
    }

    function insertnamakepala(){

        $data = DB::table('kepala_skpd')
            ->select('kodeskpd','nama','nip')
            ->get();

        foreach ($data as $xdata) {

            DB::table('users')
                ->where('id_skpd_lama',$xdata->kodeskpd)
                ->update([ 
                    'kepalaopd' => $xdata->nama, 
                    'nip' => $xdata->nip,
                    ]);
            }
    }
    function insertidbidang(){

        $data = DB::table('bidangapi')
            ->select('id','namabidang','kodeskpd')
            ->get();

        foreach ($data as $xdata) {

            DB::table('subbidangapi')
                ->where('namabidang',$xdata->namabidang)
                ->where('kodeskpd',$xdata->kodeskpd)
                ->update([ 
                    'id_bidang' => $xdata->id,
                    ]);
            }
    }

    function insertidskpddibidang(){

        $data = DB::table('users')
            ->select('id','id_skpd_lama','id_skpd')
            ->get();

        foreach ($data as $xdata) {

            DB::table('subbidangapi')
                ->where('kodeskpdlama',$xdata->id_skpd_lama)
                ->update([ 
                    'kodeskpd' => $xdata->id,
                    'id_daerah' => $xdata->id_skpd,
                    ]);
            }
    }

    function insertroleskpdnew(){

        $data = DB::table('users')
            ->select('id')
            ->get();

        foreach ($data as $xdata) {

            $cek = DB::table('role_user')
                ->where('user_id', $xdata->id)
                ->count();

                if ($cek > 0) {
                    return 'aa';
                } else {
                DB::table('role_user')
                ->insert([ 
                    'role_id' => '3', 
                    'user_id' => $xdata->id, 
                    'user_type' => 'App\User',
                    ]);
                }
            }

            
    }


    function updateprogram(){

        $data = DB::table('users')
            ->select('id','id_skpd_lama','name')
            ->get();

        foreach ($data as $xdata) {

            DB::table('program')
                ->where('kodeskpd', $xdata->id_skpd_lama)
                ->update([ 'id_skpd' => $xdata->id, 'nama_skpd' => $xdata->name, ]);
        }
        
    }

    function updatekegiatan(){

        $data = DB::table('program')
            ->select('id','kodeprogram','kodeskpd','id_skpd')
            ->get();

        foreach ($data as $xdata) {

            DB::table('kegiatan')
                ->where('kodeprogram', $xdata->kodeprogram)
                ->where('kodeskpd', $xdata->kodeskpd)
                ->update([ 

                    'id_skpd' => $xdata->id_skpd, 
                    'id_program' => $xdata->id, 
                    
                    ]);
        }
        
    }

    function textvideoupdate(){
        $text = Input::get('desc');
        $tgl = date('YmdHis');

        DB::table('sbb_video')
        ->where('id', 1)
        ->update([ 'teks' => $text, 'updateAt' => $tgl, ]);

        Session::flash('alertSuccess', 'Berhasil Memperbarui');
        return Redirect::to(route('panel.profil'));
    }

    function post() {
        $post = DB::table('postproduk')
                    ->join('produkkategori','postproduk.kategori','produkkategori.id_kategori')
                    ->join('status','postproduk.status','status.id_status')
                    ->select('produkkategori.*', 'postproduk.*','status.*')
                    ->get();

        $status = DB::table('status')
                ->select('id_status','namastatus')
                ->get();

        $kategori = DB::table('produkkategori')
                ->select('id_kategori','namakategori')
                ->get();

        return view('panel.post', ['post' => $post, 'status' => $status, 'kategori' => $kategori]);
    }

    function berita() {

        $berita = DB::table('postberita')->orderBy('createdAt','desc')->get();

        return view('panel.berita', ['berita' => $berita]);
    }


    function beritaJson() {

        $data = DB::table('postberita')
                ->select('id','img','judul','desc','tgl')
                ->orderBy('tgl','desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('gambar', function ($data)  {
                return '    <img src="/assets_public/images/berita/'.$data->img.'" height="80px">';
            })
            ->editColumn('desc', function ($data)  {
                return '    <p><strong>'.$data->judul.'</strong></p>';
            })
            ->editColumn('createdAt', function ($data)  {
                return '    <span>'.Carbon::parse($data->tgl)->format('d F Y, H:i').'</span>';
            })

            ->editColumn('aksi', function ($data)  {
                return '  
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;, &quot;'.$data->judul.'&quot;, &quot;'.$data->tgl.'&quot;, &quot;'.$data->desc.'&quot;)"><i class="fa fa-pencil"></i></button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function post2() {
        $post = DB::table('sbb_infografik')
                    -where('id', 'asc')
                    ->get();

        return view('panel.post_data', ['post' => $post]);
    }

    function lapor() {
        $post = DB::table('sbb_laporan')->get();

        return view('panel.lapor', ['post' => $post]);
    }

    function laporProses($id) {
        $post = DB::table('sbb_laporan')
                ->where('id', $id)
                ->update([ 'status' => '1' ]);

        Session::flash('alertSuccess', 'Berhasil Memperbarui');
        return Redirect::to(route('panel.lapor'));
    }

    function berita2() {
        $berita = DB::table('postberita')->get();

        return view('panel.berita_data', ['berita' => $berita]);
    }

    function produkDelete() {
        $id = Input::get('idhapus');
        $file = Input::get('gambarhapus');

        $filePath = "assets_public/file/".$file;

        if (File::exists($filePath)) {
            DB::table('sbb_infografik')
                ->where('id', '=', $id)
                ->delete();

            File::delete($filePath);
        }

        Session::flash('alertSuccess', 'Berhasil menghapus item');
        return Redirect::to(route('panel.post'));
    }

    function beritaDelete($id) {
        $file = DB::table('postberita')
                ->select('img')
                ->where('id', '=', $id)
                ->first()->img;

        $filePath = "assets_public/images/berita/".$file;

        if (File::exists($filePath)) {
            DB::table('postberita')
                ->where('id', '=', $id)
                ->delete();

            File::delete($filePath);
        }

        Session::flash('alertSuccess', 'Berhasil menghapus berita');
        return Redirect::to(route('panel.berita'));
    }

    function produkInsert() {
        $judul = Input::get('judul');
        $link = Input::get('link');
        $tgl = date('YmdHis');

        $extensiFile = Input::file('file')->getClientOriginalExtension();
        $namaFile = date('YmdHis').".".$extensiFile;
        Input::file('file')->move("assets_public/file/", $namaFile);

        DB::table('sbb_infografik')
                ->insert([

                    'judul' => $judul,
                    'gambar' => $namaFile,
                    'link' => $link,
                    'createdAt' => $tgl

                ]);

        Session::flash('alertSuccess', 'Berhasil Menambah InfoGrafik');
        return Redirect::to(route('panel.post'));
    }

    function produkEdit() {
        $id = Input::get('id');
        $judul = Input::get('judul');
        $link = Input::get('link');
        $tgl = date('YmdHis');

        if (Input::file('file')!=null) {
                $produk = DB::table('sbb_infografik')
                            ->select('gambar')
                            ->where('id', '=', $id)
                            ->first();

                Input::file('file')->move("assets_public/file/", $produk->gambar);
            }

        DB::table('sbb_infografik')
                ->where('id', '=', $id)
                ->update([

                    'judul' => $judul,
                    'link' => $link,

                ]);

        Session::flash('alertSuccess', 'Berhasil Update InfoGrafik');
        return Redirect::to(route('panel.post'));

    }

    function beritaEdit() {
        $id = Input::get('id');
        $judul = Input::get('judul');
        $desc = Input::get('desc');

        if (Input::file('file')!=null) {
                $berita = DB::table('postberita')
                            ->select('img')
                            ->where('id', '=', $id)
                            ->first();

                Input::file('file')->move("assets_public/images/berita/", $berita->img);
            }

        DB::table('postberita')
                ->where('id', '=', $id)
                ->update([

                    'judul' => $judul,
                    'desc' => $desc

                ]);

        Session::flash('alertSuccess', 'Berhasil Update Berita');
        return Redirect::to(route('panel.berita'));
    }

    function beritaInsert() {
        $judul = Input::get('judul');
        $desc = Input::get('desc');
        $createdAt = date('YmdHis');

            $extensiFile = Input::file('file')->getClientOriginalExtension();
            $namaFile = date('YmdHis').".".$extensiFile;
            Input::file('file')->move("assets_public/images/berita/", $namaFile);

        DB::table('postberita')
                ->insert([

                    'judul' => $judul,
                    'desc' => $desc,
                    'img' => $namaFile,
                    'slug' => str_slug($judul),
                    'baca' => '0',
                    'createdAt' => $createdAt

                ]);

        Session::flash('alertSuccess', 'Berhasil Menambah Berita');
        return Redirect::to(route('panel.berita'));
    }

    function profil() {
        $profil = DB::table('profil')
                    ->select('desc', 'updatedAt')
                    ->first();

        $link = DB::table('sbb_video')->first()->link;

        $text = DB::table('sbb_video')->first()->teks;

        $tgl = DB::table('sbb_video')->first()->updateAt;

        return view('panel.profil', ['profil' => $profil, 'link' => $link, 'text' => $text, 'tgl' => $tgl]);
    }

    function profilEdit() {
        $desc = Input::get('desc');
        $date = Carbon::now()->toDateTimeString();

        DB::table('profil')
            ->update(['desc' => $desc, 'updatedAt' => $date]);

        Session::flash('alertSuccess', 'Berhasil memperbarui informasi profil.');
        return Redirect::to(route('panel.profil'));
    }

    function postEdit($submenu) {
        $id = Input::get('id');
        $title = Input::get('title');
        $desc = Input::get('desc');

        $rules = [
            
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('panel.post', ['submenu' => $submenu]))->withErrors($validator)->withInput();
        } else {
            if (Input::file('img')!=null) {
                $post = DB::table('post')
                            ->select('img')
                            ->where('id', '=', $id)
                            ->first();

                Input::file('img')->move("assets_public/images/", $post->img);
            }

            DB::table('post')
                    ->where('id', '=', $id)
                    ->update(['title' => $title, 'desc' => $desc]);

            Session::flash('alertSuccess', 'Berhasil memperbarui '.$submenu.'.');
            return Redirect::to(route('panel.post', ['submenu' => $submenu]));
        }
    }

    function postDelete($id) {
        $post = DB::table('post')
                    ->join('postSubmenu', 'post.submenu', '=', 'postSubmenu.submenu')
                    ->select('img', 'post.submenu', 'postSubmenu.displayName')
                    ->where('post.id', '=', $id)
                    ->first();

        $imagePath = "assets_public/images/".$post->img;

        if (File::exists($imagePath)) {
            DB::table('post')
                ->where('id', '=', $id)
                ->delete();

            File::delete($imagePath);
        }

        Session::flash('alertSuccess', 'Berhasil menghapus '.$post->displayName.'.');
        return Redirect::to(route('panel.post', ['submenu' => $post->submenu]));
    }

    function postJson($submenu) {
        $data = DB::table('post')
                    ->join('postSubmenu', 'post.submenu', '=', 'postSubmenu.submenu')
                    ->select('post.id', 'post.submenu', 'postSubmenu.displayName', 'title', 'desc', 'img', 'post.createdAt')
                    ->where('post.submenu', '=', $submenu)
                    ->orderBy('createdAt', 'desc');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('gambar', function ($data)  {
                return '    <img src="/assets_public/images/'.$data->img.'" width="100%">';
            })
            ->editColumn('title', function ($data)  {
                return '    <p><strong>'.$data->title.'</strong></p>
                            <p>'.str_limit($data->desc, 200).'</p>';
            })
            ->editColumn('createdAt', function ($data)  {
                return '    <span>'.Carbon::parse($data->createdAt)->format('d F Y, H:i').'</span>';
            })
            ->editColumn('aksi', function ($data)  {
                return '    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"
                            onclick="alertDeletePost(&quot;'.$data->id.'&quot;, &quot;'.$data->title.'&quot;, &quot;'.$data->displayName.'&quot;)">
                                <i class="fa fa-trash"></i>
                            </button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function postJsonEdit($id) {
        $data = DB::table('postberita')
                    ->select('id', 'judul', 'desc')
                    ->where('id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'judul' => $data->judul,
            'desc' => $data->desc
        );

        echo json_encode($data);
    }

    function galeri() {
        return view('panel.galeri');
    }

    public function galeriInsert(Request $request) {
        /*$title = Input::get('title');
        $desc = Input::get('desc');

        $rules = [
            'title' => 'required|unique:galeri,title',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('showCreate');
            return Redirect::to(route('panel.galeri'))->withErrors($validator)->withInput();
        } else {
            $id = DB::table('galeri')
                    ->insertGetId([
                        'title' => $title,
                        'desc' => $desc
                    ]);

            $dataImg = array();
            foreach($request->file('img') as $file) {
                $name = $file->getClientOriginalName();
                $namaImg = date('YmdHis')."_".$name;
                $file->move("assets_public/images/", $namaImg);
                
                array_push($dataImg, [
                        'idGaleri' => $id,
                        'img' => $namaImg
                    ]);
            }
            DB::table('galeriPicture')
                ->insert($dataImg);
            
            Session::flash('alertSuccess', 'Berhasil menambah galeri.');
            return Redirect::to(route('panel.galeri'));
        }
        */
        header("Content-Type: application/json");
        $id = DB::table('galeri')
                    ->insertGetId([
                        'title' => $request->title,
                        'desc' => $request->desc,
                        'slug' => str_slug($request->title)
                    ]);

        if ($id) {
            $success = true;
            Session::put('idGaleri', $id);
        } else {
            $success = false;
        }

        $data = array(
            'success' => $success
        );

        echo json_encode($data);
    }

    public function galeriInsertImage(Request $request) {
        header("Content-Type: application/json");
        
        $result = array(
            "success" => true,
        );
        
        $dataImg = array();
        foreach($request->file('img') as $file) {
            $name = $file->getClientOriginalName();
            $namaImg = date('YmdHis')."_".$name;
            $file->move("assets_public/images/galeri/", $namaImg);
        
            array_push($dataImg, [
                    'idGaleri' => Session::get('idGaleri'),
                    'img' => $namaImg
                ]);
        }
        
        DB::table('galeriPicture')
            ->insert($dataImg);
        
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
    }

    function galeriEdit(Request $request) {
        $id = Input::get('id');
        $title = Input::get('title');
        $desc = Input::get('desc');

        $rules = [
            
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('panel.galeri'))->withErrors($validator)->withInput();
        } else {
            DB::table('galeri')
                    ->where('id', '=', $id)
                    ->update(['title' => $title, 'desc' => $desc]);

            $img = array();
            foreach($request->imgEdit as $file) {
                array_push($img, $file);
            }

            $delete = DB::table('galeriPicture')
                    ->select('img')
                    ->whereNotIn('img', $img)
                    ->where('idGaleri', '=', $id)
                    ->get();

            DB::table('galeriPicture')
                    ->whereNotIn('img', $img)
                    ->where('idGaleri', '=', $id)
                    ->delete();
            
            foreach ($delete as $rDelete) {
                $imagePath = "assets_public/images/galeri/".$rDelete->img;
                File::delete($imagePath);
            }

            Session::flash('alertSuccess', 'Berhasil memperbarui galeri.');
            return Redirect::to(route('panel.galeri'));
        }
    }

    public function galeriEditAddImage(Request $request) {
        header("Content-Type: application/json");
        
        $result = array(
            "success" => true,
        );
        
        $dataImg = array();
        foreach($request->file('imgEditAddImage') as $file) {
            $name = $file->getClientOriginalName();
            $namaImg = date('YmdHis')."_".$name;
            $file->move("assets_public/images/galeri/", $namaImg);
        
            array_push($dataImg, [
                    'idGaleri' => $request->idGaleri,
                    'img' => $namaImg
                ]);
        }
        
        DB::table('galeriPicture')
            ->insert($dataImg);
        
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
    }

    function galeriDelete($id) {
        DB::table('galeri')
            ->where('id', '=', $id)
            ->delete();

        $galeri = DB::table('galeriPicture')
                    ->select('img')
                    ->where('idGaleri', '=', $id)
                    ->get();

        foreach ($galeri as $rGaleri) {
            $imagePath = "assets_public/images/galeri/".$rGaleri->img;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        DB::table('galeriPicture')
            ->where('idGaleri', '=', $id)
            ->delete();

        Session::flash('alertSuccess', 'Berhasil menghapus galeri.');
        return Redirect::to(route('panel.galeri'));
    }

    function galeriJson() {
        $data = DB::select('SELECT id, (SELECT img FROM galeriPicture WHERE idGaleri = galeri.id LIMIT 1) AS img, title, `desc`, createdAt FROM galeri ORDER BY createdAt DESC');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('gambar', function ($data)  {
                return '    <img src="/assets_public/images/galeri/'.$data->img.'" width="100%">';
            })
            ->editColumn('desc', function ($data)  {
                return '    <p><strong>'.$data->title.'</strong></p>
                            <p>'.str_limit($data->desc, 250).'</p>';
            })
            ->editColumn('createdAt', function ($data)  {
                return '    <span>'.Carbon::parse($data->createdAt)->format('d F Y, H:i').'</span>';
            })
            ->editColumn('aksi', function ($data)  {
                return '    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addImageModal" onclick="butEditAddImage(&quot;'.$data->id.'&quot;)"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"
                                onclick="alertDelete(&quot;'.$data->id.'&quot;, &quot;'.$data->title.'&quot;, &quot;galeri&quot;, &quot;galeri&quot;)">
                                    <i class="fa fa-trash"></i>
                            </button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function galeriJsonEdit($id) {
        $data = DB::table('galeri')
                    ->select('id', 'title', 'desc')
                    ->where('id', '=', $id)
                    ->first();

        $img = DB::table('galeriPicture')
                    ->select('id', 'img')
                    ->where('idGaleri', '=', $id)
                    ->get();
                    
        $data = array(
            'id' => $data->id,
            'title' => $data->title,
            'desc' => $data->desc,
            'img' => $img
        );

        echo json_encode($data);
    }

    

    function link() {
        $linkSosmedFacebook = DB::table('linkSosmed')
                                ->select('link')
                                ->where('desc', '=', 'facebook')
                                ->first();

        $linkSosmedTwitter = DB::table('linkSosmed')
                                ->select('link')
                                ->where('desc', '=', 'twitter')
                                ->first();

        $linkSosmedFlickr = DB::table('linkSosmed')
                                ->select('link')
                                ->where('desc', '=', 'flickr')
                                ->first();

        $linkSosmedGoogle = DB::table('linkSosmed')
                                ->select('link')
                                ->where('desc', '=', 'google')
                                ->first();

        return view('panel.link', ['linkSosmedFacebook' => $linkSosmedFacebook, 'linkSosmedTwitter' => $linkSosmedTwitter, 'linkSosmedFlickr' => $linkSosmedFlickr, 'linkSosmedGoogle' => $linkSosmedGoogle]);
    }

    function linkTerkaitJson() {
        $data = DB::table('linkTerkait')
                    ->select('id', 'title', 'link');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function ($data)  {
                return '    <div class="tooltip-demo">
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editLinkTerkaitModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-sm btn-danger" 
                                    onclick="alertDelete(&quot;'.$data->id.'&quot;, &quot;'.$data->title.'&quot;, &quot;link&quot;, &quot;link&quot;)" 
                                    title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function linkTerkaitJsonEdit($id) {
        $data = DB::table('linkTerkait')
                    ->select('id', 'title', 'link')
                    ->where('id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'title' => $data->title,
            'link' => $data->link,
        );

        echo json_encode($data);
    }

    function linkTerkaitInsert() {
        $title = Input::get('title');
        $link = Input::get('link');

        $rules = [
            'title' => 'required',
            'link' => 'required|url'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('showCreate');
            return Redirect::to(route('panel.link'))->withErrors($validator)->withInput();
        } else {
            DB::table('linkTerkait')
                ->insert(['title' => $title, 'link' => $link]);

            Session::flash('alertSuccess', 'Berhasil menambah link terkait.');
            return Redirect::to(route('panel.link'));
        }
    }

    function linkEditSosmed() {
        $facebook = !empty(Input::get('facebook')) ? Input::get('facebook') : '';
        $twitter = !empty(Input::get('twitter')) ? Input::get('twitter') : '';
        $flickr = !empty(Input::get('flickr')) ? Input::get('flickr') : '';
        $google = !empty(Input::get('google')) ? Input::get('google') : '';

        $rules = [
            
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('panel.link'))->withErrors($validator)->withInput();
        } else {
            DB::table('linkSosmed')
                    ->where('desc', '=', 'facebook')
                    ->update(['link' => $facebook]);

            DB::table('linkSosmed')
                    ->where('desc', '=', 'twitter')
                    ->update(['link' => $twitter]);
            
            DB::table('linkSosmed')
                    ->where('desc', '=', 'flickr')
                    ->update(['link' => $flickr]);

            DB::table('linkSosmed')
                    ->where('desc', '=', 'google')
                    ->update(['link' => $google]);

            Session::flash('alertSuccess', 'Berhasil memperbarui link media sosial.');
            return Redirect::to(route('panel.link'));
        }
    }

    function linkTerkaitDelete($id) {
        DB::table('linkTerkait')
            ->where('id', '=', $id)
            ->delete();

        Session::flash('alertSuccess', 'Berhasil menghapus link terkait.');
        return Redirect::to(route('panel.link'));
    }

    function settings() {
        $setting = DB::table('settings')
                    ->select('namaOpd', 'logo', 'theme')
                    ->first();

        $theme = DB::table('theme')
                    ->select('styleName', 'displayName')
                    ->orderBy('displayName')
                    ->get();

        return view('panel.settings', ['setting' => $setting, 'theme' => $theme]);
    }

    function settingsEdit() {
        $namaOpd = Input::get('namaOpd');
        $theme = Input::get('styleName');
        
        DB::table('settings')
            ->update(['namaOpd' => $namaOpd, 'theme' => $theme]);

        if (Input::file('logo')!=null) {
            Input::file('logo')->move("assets_public/images/", 'logo.png');
        }

        Session::flash('alertSuccess', 'Berhasil memperbarui konfigurasi website.');
        return Redirect::to(route('panel.settings'));
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

    function agenda() {
        $agenda = DB::table('agenda')
                    ->select('hari', 'tanggal', 'pejabat', 'lokasi', 'kegiatan', 'bulan')
                    ->get();

        return view('panel.agenda', ['agenda' => $agenda]);
    }

    function agendaJson() {
        $data = DB::table('agenda')
                    ->select('id','hari','pejabat','lokasi', 'kegiatan', 'bulan')
                    ->orderBy('created_at', 'desc');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('hari', function ($data)  {
                return '    <span>'.$data->hari.'</span>';
            })
            ->editColumn('pejabat', function ($data)  {
                return '    <span>'.$data->pejabat.'</span>';
            })
            ->editColumn('lokasi', function ($data)  {
                return '    <span>'.$data->lokasi.'</span>';
            })
            ->editColumn('kegiatan', function ($data)  {
                return '    <span>'.$data->kegiatan.'</span>';
            })
            ->editColumn('bulan', function ($data)  {
                return '    <span>'.$data->bulan.'</span>';
            })
            ->editColumn('aksi', function ($data)  {
                return '    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                
                            <button class="btn btn-sm btn-danger"
                            onclick="alertDeletePostAgenda(&quot;'.$data->id.'&quot;, &quot;'.$data->kegiatan.'&quot;, &quot;'.$data->hari.'&quot;)">
                                <i class="fa fa-trash"></i>
                            </button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function agendaInsert() {
        $hari = Input::get('hari');
        $tanggal = Input::get('tanggal');
        $pejabat = Input::get('pejabat');
        $bulan = Input::get('bulan');
        $lokasi = Input::get('lokasi');
        $kegiatan = Input::get('kegiatan');

            DB::table('agenda')
                ->insert([  'bulan' => $bulan,
                            'lokasi' => $lokasi,
                            'kegiatan' => $kegiatan,
                            'hari' => $hari, 
                            'tanggal' => $tanggal,
                            'pejabat' => $pejabat,
                            'user_id' => Auth::user()->id]);

            Session::flash('alertSuccess', 'Berhasil menambah.');
            return Redirect::to(route('panel.agenda'));
        
    }

     function agendaDelete($id) {
                 DB::table('agenda')
                    ->where('id', '=', $id)
                    ->delete();

        Session::flash('alertSuccess', 'Berhasil menghapus Agenda.');
        return Redirect::to(route('panel.agenda'));
    }

    function agendaJsonEdit($id) {

        $data = DB::table('agenda')
                    ->select('id','hari','tanggal','pejabat','lokasi', 'kegiatan','bulan')
                    ->where('id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'hari' => $data->hari,
            'tanggal' => $data->tanggal,
            'pejabat' => $data->pejabat,
            'lokasi' => $data->lokasi,
            'kegiatan' => $data->kegiatan,
            'bulan' => $data->bulan
        );

        echo json_encode($data);
    }

    function agendaEdit() {
        $id = Input::get('id');
        $hari = Input::get('hari');
        $tanggal = Input::get('tanggal');
        $pejabat = Input::get('pejabat');
        $bulan = Input::get('bulan');
        $lokasi = Input::get('lokasi');
        $kegiatan = Input::get('kegiatan');

            DB::table('agenda')
                ->where('id', '=', $id)
                ->update([  'bulan' => $bulan,
                            'lokasi' => $lokasi,
                            'kegiatan' => $kegiatan,
                            'hari' => $hari,
                            'tanggal' => $tanggal,
                            'pejabat' => $pejabat]);

            Session::flash('alertSuccess', 'Berhasil Update.');
            return Redirect::to(route('panel.agenda'));
        
    }

    function download() {
        $download = DB::table('download')
                    ->select('id','title','file','created_at')
                    ->get();

        return view('panel.download', ['download' => $download]);
    }

        function downloadJson() {
        $data = DB::table('download')
                    ->select('id','title','file','created_at')
                    ->orderBy('created_at', 'desc');
                    
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('title', function ($data)  {
                return '    <span>'.$data->title.'</span>';
            })
            ->editColumn('file', function ($data)  {
                return '    <span>'.$data->file.'</span>';
            })
            ->editColumn('created_at', function ($data)  {
                return '    <span>'.$data->created_at.'</span>';
            })
            ->editColumn('aksi', function ($data)  {
                return '    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                
                            <button class="btn btn-sm btn-danger"
                            onclick="alertDeletePostDownload(&quot;'.$data->id.'&quot;, &quot;'.$data->title.'&quot;, &quot;'.$data->file.'&quot;)">
                                <i class="fa fa-trash"></i>
                            </button>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function downloadInsert() {
        $title = Input::get('judul');
        $created_at = Carbon::now('Asia/Makassar');

        $rules = [
            
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to(route('panel.download'))->withErrors($validator)->withInput();
        } else {
            if (Input::has('file')) {
                $extensi = Input::file('file')->getClientOriginalExtension();
                $nama = date('YmdHis').".".$extensi;
                Input::file('file')->move("assets_public/download/", $nama);
            } else {
                $nama = '';
            }

            DB::table('download')
                ->insert([  'title' => $title,
                            'file' => $nama,
                            'created_at' => $created_at ]);

            Session::flash('alertCreateDownloadSuccess', 'Berhasil mengupload file.');
            return Redirect::to(route('panel.download'));
        }
    }

    function downloadDelete($id) {
            $file = DB::table('download')
                    ->select('file')
                    ->where('id', '=', $id)
                    ->first();

                    File::delete("assets_public/download/{$file->file}");

                    DB::table('download')
                    ->where('id', '=', $id)
                    ->delete();

        Session::flash('alertSuccess', 'Berhasil menghapus Informasi Publik.');
        return Redirect::to(route('panel.download'));
    }

    function downloadJsonEdit($id) {

        $data = DB::table('download')
                    ->select('id','title','file')
                    ->where('id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'title' => $data->title,
            'file' => $data->file
        );

        echo json_encode($data);
    }

    function downloadEdit() {
        $id = Input::get('id');
        $title = Input::get('judul');

        $namalama = DB::table('download')
                    ->select('file')
                    ->where('id', '=', $id)
                    ->first();

        if (Input::has('file')) {
                $extensi = Input::file('file')->getClientOriginalExtension();
                $nama = date('YmdHis').".".$extensi;
                Input::file('file')->move("assets_public/download/", $nama);
            } else {
                $nama = $namalama->file;
            }

            DB::table('download')
                ->where('id', '=', $id)
                ->update([  'title' => $title,
                            'file' => $nama

                        ]);

            Session::flash('alertSuccess', 'Berhasil Update.');
            return Redirect::to(route('panel.download'));
        
    }

    function struktur() {
        $struktur = DB::table('struktur')
                    ->select('desc', 'updatedAt')
                    ->first();

        return view('panel.struktur', ['struktur' => $struktur]);
    }

    function strukturEdit() {
        $desc = Input::get('desc');
        $date = Carbon::now()->toDateTimeString();

        DB::table('struktur')
            ->update(['desc' => $desc, 'updatedAt' => $date]);

        Session::flash('alertSuccess', 'Berhasil memperbarui informasi struktur.');
        return Redirect::to(route('panel.struktur'));
    }

    function kontak() {
        $data = DB::table('contact')
                    ->select('alamat', 'noTlp','jamBuka')
                    ->first();

        return view('panel.kontak', ['data' => $data]);
    }

    function kontakEdit() {
        $alamat = Input::get('alamat');
        $notlp = Input::get('notlp');
        $jambuka = Input::get('jambuka');

        DB::table('contact')
            ->where('id','=', 1)
            ->update(['alamat' => $alamat, 'noTlp' => $notlp, 'jamBuka' => $jambuka]);

        Session::flash('alertSuccess', 'Berhasil memperbarui Kontak.');
        return Redirect::to(route('panel.kontak'));
    }




























    function users() {

        return view('panel.users');
    }

    function usersInsert() {

        $nama = Input::get('nama');
        $email = Input::get('email');
        $username = Input::get('username');
        $role_id = '2';
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
                $user->save();
                $role_id = '2';
                $role = Role::where('id', '=', $role_id)
                            ->first();
                $user->attachRole($role);
                return null;
            } else {
                return false;
            }
            
        }
    }

    function usersEdit() {
        $id = Input::get('id');
        $email = Input::get('email');
        $username = Input::get('username');

        $rules = [
            'username' => 'required',
            'email' => 'required|email',
        ];

        $validator = Validator::make(Input::all(), $rules);

        $cek = DB::table('users')
            ->where('username', '=', $username)
            ->count();

        if ($validator->fails()) {
            return false;
        } else {

            if ($cek != 1) {
            DB::table('users')
                    ->where('id', '=', $id)
                    ->update(['email' => $email, 'username' => $username]);

            return null;
            }else{
                return false;
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
                    ->select('users.id', 'users.name', 'users.username', 'users.lastlogin', 'email', 'roles.display_name', 'roles.color', 'users.created_at')
                    ->where('roles.name', '!=', 'superadmin')
                    ->where('roles.name', '!=', 'skpd')
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
                return '    <div class="tooltip-demo">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" 
                                    onclick="ResetPass(&quot;'.$data->id.'&quot;)" 
                                    title="Tooltip on left">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit(&quot;'.$data->id.'&quot;)"><i class="fa fa-pencil"></i></button>
                            </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function usersJsonEdit($id) {
        $data = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->select('users.id', 'users.name', 'username', 'email', 'role_user.role_id')
                    ->where('users.id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email
        );

        echo json_encode($data);
    }



    function usersSkpd() {

        return view('panel.usersSkpd');
    }

    function usersSkpdInsert() {

        $nama = Input::get('nama');
        $email = Input::get('email');
        $username = Input::get('username');
        $role_id = '3';
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
                $user->id_skpd = Auth::user()->id;
                $user->lastlogin = date('Y-m-d H:i:s');
                $user->username = $username;
                $user->password = $password;
                $user->save();
                $role_id = '3';
                $role = Role::where('id', '=', $role_id)
                            ->first();
                $user->attachRole($role);
                return null;
            } else {
                return false;
            }
            
        }
    }

    function usersSkpdEdit() {
        $id = Input::get('id');
        $email = Input::get('Email');
        $username = Input::get('Username');

        $rules = [
            'Username' => 'required',
            'Email' => 'required|email',
        ];

        $validator = Validator::make(Input::all(), $rules);

        $cek = DB::table('users')
            ->where('id', '=', $id)
            ->where('username', '=', $username)
            ->count();

        if ($validator->fails()) {
            return false;
        } else {
            DB::table('users')
                    ->where('id', '=', $id)
                    ->update(['email' => $email, 'username' => $username]);

            return null;
        }
    }

    function usersSkpdDelete($id) {
        DB::table('users')
            ->where('id', '=', $id)
            ->delete();

        DB::table('role_user')
            ->where('user_id', '=', $id)
            ->delete();

        return null;
    }

    function usersSkpdReset($id) {
        $users = DB::table('users')
                    ->select('name', 'username')
                    ->where('id', '=', $id)
                    ->first();

        DB::table('users')
            ->where('id', '=', $id)
            ->update(['password' => bcrypt($users->username)]);

        return null;
    }

    function usersSkpdJson() {
        $data = DB::table('users')
                    ->join('role_user', 'user_id', '=', 'users.id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->select('users.id', 'users.name', 'users.username', 'users.lastlogin', 'email', 'roles.display_name', 'roles.color', 'users.created_at')
                    ->where('roles.name', '!=', 'superadmin')
                    ->where('roles.name', '!=', 'admin')
                    ->where('users.id_skpd', '=', Auth::user()->id)
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
                return '    <div class="tooltip-demo">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" 
                                    onclick="ResetPass(&quot;'.$data->id.'&quot;)" 
                                    title="Tooltip on left">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="EditData(&quot;'.$data->id.'&quot;,&quot;'.$data->username.'&quot;,&quot;'.$data->email.'&quot;)"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-sm btn-danger" 
                                    onclick="HapusData(&quot;'.$data->id.'&quot;)" 
                                    title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
            })
            ->escapeColumns([])
            ->make(true);
    }

    function usersSkpdJsonEdit($id) {
        $data = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->select('users.id', 'users.name', 'username', 'email', 'role_user.role_id')
                    ->where('users.id', '=', $id)
                    ->first();
                    
        $data = array(
            'id' => $data->id,
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email
        );

        echo json_encode($data);
    }

}