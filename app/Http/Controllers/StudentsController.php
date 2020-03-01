<?php

namespace App\Http\Controllers;

use App\Menulist;
use App\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function show(){
        if(auth()->user()->role==2 || auth()->user()->role==0)
        {
            $students = User::where('role',1)->where('status',1)->orderBy('name')->get();
            $abetka = [];
            $years = [];
            $groups = [];
            foreach ($students as $key => $val)
            {
                $abetka[mb_substr($val->name,0,1)][]=$val->name;
                $years[$val->year_in][]=1;
                $groups[$val->group][]=1;
            }
            ksort($years);
            ksort($groups);

//            dd($years);
            return view('students',
                [
                    'abetka'=>$abetka,
                    'years'=>$years,
                    'groups'=>$groups,
                ]);
        } else return "Access denied! <p><a href='/'>Return to main page</a></p>";
    }

    public function abetka($alpha){
        if(auth()->user()->role==2 || auth()->user()->role==0)
        {
            $students = User::where('role',1)->where('name','like',$alpha.'%')->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('abetka',
                [
                    'students'=>$students,
                ]);
        } else return "Access denied! <p><a href='/'>Return to main page</a></p>";
    }

    public function groups($group){
        if(auth()->user()->role==2 || auth()->user()->role==0)
        {
            $students = User::where('role',1)->where('group',$group)->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('groups',
                [
                    'students'=>$students,
                ]);
        } else return "Access denied! <p><a href='/'>Return to main page</a></p>";
    }

    public function years($year){
        if(auth()->user()->role==2 || auth()->user()->role==0)
        {
            $students = User::where('role',1)->where('year_in',$year)->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('years',
                [
                    'students'=>$students,
                ]);
        } else return "Access denied! <p><a href='/'>Return to main page</a></p>";
    }

    public function cabinet($id){

        if(auth()->user()->role==2 || auth()->user()->role==0 || $id==auth()-user()->id)
        {
            $passportMenu = Menulist::where(['menu_id'=>'3','active'=>1])->orderBy('order')->get();
            $student = User::where('role',1)->where('id',$id)->where('status',1)->get();

//            dd($students);
            return view('cabinet',
                [
                    'student'=>$student,
                    'passportMenu'=>$passportMenu,
                ]);
        } else return "Access denied! <p><a href='/'>Return to main page</a></p>";
    }
}