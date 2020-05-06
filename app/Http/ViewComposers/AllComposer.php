<?php

namespace App\Http\ViewComposers;

use Cookie;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class AllComposer {
    public function compose(View $view) {
        // $settings = DB::table('settings')
        //                 ->select('namaOpd', 'logo')
        //                 ->first();
        
        // $menuAtas = DB::table('postSubmenu')
        //             ->select('submenu', 'displayName')
        //             ->get();

    	// $view->with(['settings' => $settings, 'menuAtas' => $menuAtas]);
    }
}