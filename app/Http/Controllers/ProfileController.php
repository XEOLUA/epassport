<?php

namespace App\Http\Controllers;

use App\Article;
use App\Menulist;
use App\Slider;
use App\User;
use App\Worker;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){

        if(auth()->check()) {
            return view('profile');
        }
        else return redirect()->route('login');

    }

    public function edit(Request $request){
        $user = User::where('id',auth()->user()->id)->first();
        $data = $request->all();

        $success = 0;

        if(password_verify($data['password'], $user->password)){
//            dd($data['name']);
            $user->name = $data['name'];
            $user->group = $data['group'];
            $user->sex = $data['sex'];
            $user->birthday = $data['birthday'];
            $user->address = $data['address'];
            $user->year_in = $data['year_in'];
            $user->parents = $data['parents'];
            $success = $user->save();
            $success ? $message = "Дані успішно збережено" : $message = "Деяка помилка";
        } else $message = "Не вірний пароль!";
      return redirect()->route('profile')->with(['flash_message' => $message, 'success'=>$success]);
    }
}
