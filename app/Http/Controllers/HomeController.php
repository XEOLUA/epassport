<?php

namespace App\Http\Controllers;

use App\Menulist;
use App\Slider;
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
      return view('index',['mainMenu'=>$mainMenu, 'slider'=>$slider]);
    }

}
