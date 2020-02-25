<?php

namespace App\Http\Controllers;

use App\Article;
use App\Menulist;
use App\Slider;
use App\Worker;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $mainMenu = Menulist::where(['menu_id'=>'1','active'=>1])->orderBy('order')->get();
      $slider = Slider::where('active',1)->orderBy('order')->get();
      $workers = Worker::where('active',1)->orderBy('order')->get();
      $articles = Article::where('active',1)->orderBy('order')->get()->take(3);

//      dd(auth()->user()->role);

      return view('index',
          [
              'mainMenu'=>$mainMenu,
              'slider'=>$slider,
              'workers'=>$workers,
              'articles'=>$articles,
          ]);
    }

}
