<?php

namespace App\Providers;

use App\Article;
use App\Menulist;
use App\Menus;
use App\Quastion;
use App\Slider;
use App\Test;
use App\User;
use App\Worker;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        User::class => 'App\Http\Sections\Users',
        Menus::class => 'App\Http\Sections\Menuses',
        Menulist::class => 'App\Http\Sections\Menulists',
        Slider::class => 'App\Http\Sections\Sliders',
        Worker::class => 'App\Http\Sections\Workers',
        Article::class => 'App\Http\Sections\Articles',
        Test::class => 'App\Http\Sections\Tests',
        Quastion::class => 'App\Http\Sections\Quastions',
    ];

    /**
     * Register sections.
     *
     * @param \SleepingOwl\Admin\Admin $admin
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
