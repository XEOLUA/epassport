<?php


namespace App\Services;


class d
{
 static public function d($data,$stop=null){
     echo "<pre>Dump:<br>";
     print_r($data);
     echo "</pre>";
     if($stop!=null && $stop!=0) exit();
 }
}
