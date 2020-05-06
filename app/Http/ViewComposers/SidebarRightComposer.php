<?php

namespace App\Http\ViewComposers;

use Cookie;
use Request;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class SidebarRightComposer {
    public function compose(View $view) {
        // $postSubmenu = DB::table('postSubmenu')
        //             ->select('submenu')
        //             ->get();

        // foreach ($postSubmenu as $rPostSubmenu) {
        //     if (Request::is('post/'.$rPostSubmenu->submenu.'*')) {
        //         $submenu = $rPostSubmenu->submenu;
        //     }
        // }

        // $post = DB::table('post')
        //             ->select('title', 'img', 'slug', 'createdAt')
        //             ->where('submenu', '=', $submenu)
        //             ->orderBy('createdAt', 'DESC')
        //             ->paginate(5);

    	// $view->with(['post' => $post, 'submenu' => $submenu]);
    }
}