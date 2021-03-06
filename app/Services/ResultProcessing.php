<?php


namespace App\Services;


class ResultProcessing
{

   static function func($ar_questions,$ar_results,$function=null){
       $sum = 0;
       $cnt = 0;
//       dd($ar_results);
       unset($ar_results['_token']);
           foreach ($ar_results as $key => $res){
               if(in_array(key($res),$ar_questions))
                foreach ($res as $r){
                    foreach ($r as $v)
                    if(is_numeric($v)) {
                        $sum+=$v;
                    }
                }
           }
//       dd($sum);
       if($function=='sum' || $function==null) return $sum;
       if($function=='average'){
           if(count($ar_questions)>0) return round($sum/count($ar_questions),2);
           else return false;
       }

   }


  static function calc($ar_par,$ar_res){
      $ans=0;
      switch ($ar_par[0]){
          case 'sum':{
              $ans = 0;
              $params = explode(",",$ar_par[1]);
              $ar_q=[];
              foreach ($params as $param){
                  if($param=='all'){
                      foreach ($ar_res as $key => $res)
                        if($key!='_token')$ar_q[]=key($res);
                  } else
                    if(strpos($param,"-"))
                      {
                        $q=explode("-",$param);
                        for($i=1*$q[0];$i<=1*$q[1];$i++)
                            $ar_q[]=$i;
                  } else
                        $ar_q[]=$param;
              }
//              dd($ar_res);
              $ans = self::func($ar_q,$ar_res,'sum');
              break;
          }
          case 'average':{
              $ans = 0;
              $params = explode(",",$ar_par[1]);
              $ar_q=[];
              foreach ($params as $param){
                  if($param=='all'){
                      foreach ($ar_res as $key => $res)
                          if($key!='_token')$ar_q[]=key($res);
                  } else
                      if(strpos($param,"-"))
                      {
                          $q=explode("-",$param);
                          for($i=1*$q[0];$i<=1*$q[1];$i++)
                              $ar_q[]=$i;
                      } else
                          $ar_q[]=$param;
              }
//              dd($ar_res);
              $ans = self::func($ar_q,$ar_res,'average');
              break;
          }
      }
   return $ans;
  }

  public static function processing($array_result=null,$array_opt=null){
//       dd($array_result);
     $result ="";
      if($array_result && $array_opt)
      {
          $array_opt=explode("\r\n",$array_opt);

          foreach($array_opt as $option){
              $ar_par[] = explode("/",$option);
          }

          foreach ($ar_par as $item){
              $t=self::calc($item,$array_result);
              if(isset($item[3])){
                  $answers = explode("|",$item[3]);
                  $flag=1;
                  foreach ($answers as $answer){
                      $ans = explode("*",$answer);
                      $dist = explode(":",$ans[0]);

                      if($t>=$dist[0] && $t<=$dist[1]){
                          //якщо результат потрапив в проміжок
                          $result.=$ans[1]."(".$dist[0].";".$dist[1].")=".$t."\n";
                          $flag=0;
                         // break;
                      }
                  }
              //Якщо результат не потрапив в жодин з проміжків буде виведенно ф-я та результат обчислення
              if($flag) $result.=$item[2]."(".$item[1].")=".$t."\n";
              }
              else //якщо не було таблиці підстановки
               $result.=$item[2]."(".$item[1].")=".$t."\n";
          }

          return $result;
         // dd($array_result,$array_opt);
      }
  }

}
