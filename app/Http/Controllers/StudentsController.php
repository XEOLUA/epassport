<?php

namespace App\Http\Controllers;

use App\Ambulcard;
use App\Anamnest;
use App\Menulist;
use App\Test;
use App\TestInMenu;
use App\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function show(){

        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0))
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
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function abetka($alpha){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0))
        {
            $students = User::where('role',1)->where('name','like',$alpha.'%')->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('abetka',
                [
                    'students'=>$students,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function groups($group){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0))
        {
            $students = User::where('role',1)->where('group',$group)->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('groups',
                [
                    'students'=>$students,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function years($year){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0))
        {
            $students = User::where('role',1)->where('year_in',$year)->where('status',1)->orderBy('name')->get();

//            dd($students);
            return view('years',
                [
                    'students'=>$students,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function cabinet($id){
//dd(auth()->user());
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0 || $id==auth()->user()->id))
        {
            $passportMenu = Menulist::where(['menu_id'=>'3','active'=>1])->orderBy('order')->get();
            $student = User::where('role',1)->where('id',$id)->where('status',1)->get();

//            dd($students);
            return view('cabinet',
                [
                    'student'=>$student,
                    'passportMenu'=>$passportMenu,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function ambulat($student_id){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0 || $student_id==auth()->user()->id))
        {

            $student = User::where('role',1)->where('id',$student_id)->where('status',1)->get();
            $ambulatRecords = Ambulcard::where('user_id',$student_id)->orderBy('updated_at')->orderBy('created_at')->get();
//            dd($students);
            return view('ambulat',
                [
                    'student'=>$student,
                    'ambulatRecords' => $ambulatRecords,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function anamn($student_id){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0 || $student_id==auth()->user()->id))
        {

            $student = User::where('role',1)->where('id',$student_id)->where('status',1)->get();
            $ambulatRecords = Anamnest::where('user_id',$student_id)->orderBy('updated_at')->orderBy('created_at')->get();
//            dd($students);
            return view('anamn',
                [
                    'student'=>$student,
                    'anamnRecords' => $ambulatRecords,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }
    }

    public function listads($student_id){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0 || $student_id==auth()->user()->id))
        {
//            $tests_id = [1,2,4,5];
            $tests_id=TestInMenu::where('menuitem_id',5)->get()->pluck('test_id','test_id')->toArray();
//            dd($tests_id);
            $student = User::where('role',1)->where('id',$student_id)->where('status',1)->get();
            $tests = Test::whereIn('id',$tests_id)->get();
//            dd($tests);
            return view('listads',
                [
                    'tests'=>$tests,
                    'student' => $student,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }

    }

    public function listpsihtest($student_id){
        if(auth()->check() && (auth()->user()->role==2 || auth()->user()->role==0 || $student_id==auth()->user()->id))
        {
            $tests_id=TestInMenu::where('menuitem_id',9)->get()->pluck('test_id','test_id')->toArray();
//            dd($tests_id);
            $student = User::where('role',1)->where('id',$student_id)->where('status',1)->get();
            $tests = Test::whereIn('id',$tests_id)->get();
//            dd($tests);
            return view('listpsihtest',
                [
                    'tests'=>$tests,
                    'student' => $student,
                ]);
        } else
        {
            if(auth()->check()) return "Access denied! <p><a href='/'>Return to main page</a></p>";
            else return redirect()->route('login');
        }

    }

}




