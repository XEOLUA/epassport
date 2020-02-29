<?php

namespace App\Providers;

use App\Menulist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home.header', function($view) {
            $mainMenu = Menulist::where(['menu_id'=>'1','active'=>1])->orderBy('order')->get();
            $userMenu = Menulist::where(['menu_id'=>'2','active'=>1])->orderBy('order')->get();

//            dd($mainMenu);

            $view->with(['mainMenu' => $mainMenu,
                'userMenu'=>$userMenu]);
        });
    }
}
