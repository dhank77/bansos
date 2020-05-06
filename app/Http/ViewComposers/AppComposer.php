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

class AppComposer {
    public function compose(View $view) {
        // $theme = DB::table('settings')
        //                 ->select('theme')
        //                 ->first();

        // $linkSosmed = DB::table('linkSosmed')
        //                 ->select('icon', 'link')
        //                 ->where('link', '!=', '')
        //                 ->get();

        // $linkTerkait = DB::table('linkTerkait')
        //                 ->select('title', 'link')
        //                 ->get();

        // $berita = DB::table('post')
        //             ->select('title', 'slug', 'submenu')
        //             ->where('submenu', '=', 'berita')
        //             ->orderBy('createdAt', 'desc')
        //             ->limit(3)
        //             ->get();

    	// $view->with(['theme' => $theme, 'linkSosmed' => $linkSosmed, 'linkTerkait' => $linkTerkait, 'berita' => $berita]);
    }
}