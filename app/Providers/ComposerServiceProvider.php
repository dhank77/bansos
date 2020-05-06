<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {
    public function boot() {
        View::composer(
            ['*'],
            'App\Http\ViewComposers\AllComposer'
        );

        View::composer(
            ['layouts.app'],
            'App\Http\ViewComposers\AppComposer'
        );

        View::composer(
            ['include.sidebarRight'],
            'App\Http\ViewComposers\SidebarRightComposer'
        );

        //Panel
        View::composer(
            ['panel.layouts.app'],
            'App\Http\ViewComposers\Panel\AppComposer'
        );
    }
}