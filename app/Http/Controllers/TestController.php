<?php

namespace App\Http\Controllers;

use App\Question;
use App\Result;
use App\Services\ResultProcessing;
use App\Student;
use App\Test;
use App\User;
use DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show($test_id, $user_id){

        if(auth()->check() &&
            (auth()->user()->role==0 ||
             auth()->user()->role==2 ||
             auth()->user()->id==$user_id
            )
        ){
            $res = Result::where(['test_id'=>$test_id,'user_id'=>$user_id])->get();
            $student = Student::where('id',$user_id)->get();
            $test = Test::where('id',$test_id)->get();

//            dd($res,$test);
$proc=[];

            if(count($res) && $test[0]->settings)
                foreach ($res as $key =>$r){
                    $proc[$key] = ResultProcessing::processing(unserialize($r->answers),$test[0]->settings);
                };

//                dd($proc);
            $questions = Question::where('test_id',$test_id)->get();
            return view('results',
                [
                    'results'=>$res,
                    'student'=>$student,
                    'test'=>$test,
                    'questions'=>$questions,
                    'proc'=>$proc
                ]);
        }
        else return redirect()->route('login');
    }

    public function run($test_id){
        if(auth()->check())
        {
            $test = Test::where('id',$test_id)->get();

            $questions = Question::with('relshipQuestionsAnswers')
                ->where('test_id',$test_id)
                ->get();

//            dd($questions);

            return view('testrun',
                [
                    'test' => $test,
                    'questions' => $questions,
                ]);
        }
        else return redirect()->route('login');
    }

    public function save($test_id,Request $request){

        if(auth()->check())
        {
            $data= $request->all();
//            dd($test_id,$user_id,$data);
            $res = new Result;
            $res->test_id = $test_id;
            $res->user_id = auth()->id();
//dd($data);
            $res->answers = serialize($data);

            $res->save();

            return redirect()->route('testshow',
                ['test_id' => $test_id,
                 'user_id' => auth()->id()
                    ]);
        }
        redirect('/login');
    }
}
