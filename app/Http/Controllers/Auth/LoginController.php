<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    use AuthenticatesUsers;

    protected $redirectTo = '/panel';

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/panel');
    }

    protected function credentials(Request $request){
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('roles.display_name','users.aktif')
            ->where('users.username', '=', $request->get($this->username()))
            ->orWhere('users.email', '=', $request->get($this->username()))
            ->first();

        if($users->aktif == '0'){
            Session::flash('alertGagal', 'Akun tidak aktif, silahkan hubungi admin BKD untuk mengaktifkan!');
            return [
                $field => $request->get($this->username()),
                'password' => '09292838817726266361',
            ];
        }else{
            Session::put('role', $users->display_name);
            return [
                $field => $request->get($this->username()),
                'password' => $request->password,
            ];

        }
    }
}
