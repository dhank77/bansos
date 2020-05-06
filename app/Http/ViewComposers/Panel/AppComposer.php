<?php

namespace App\Http\ViewComposers\Panel;

use Cookie;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class AppComposer {
    public function compose(View $view) {
        // $postSubmenu = DB::table('postSubmenu')
        //                 ->select('submenu', 'displayName')
        //                 ->orderBy('displayName')
        //                 ->get();

    	// $view->with(['postSubmenu' => $postSubmenu]);
    }
}