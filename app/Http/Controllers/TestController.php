<?php

namespace App\Http\Controllers;
use Illuminate\Suppor\Facades\Redis;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
     public function hello()
     {
     echo __METHOD__;echo '<br>';
     echo date('Y-m-d H:i:s');
     }

     public function redis1(){
       echo  '代码傻逼';
       echo '代码没爹';

     }

     public function test1(){
         $data = [
             'name' =>'zhangsan',
             'email'=>'3238811454@qq.com'
         ];
         return $data;
//         echo json_encode($data);
     }
}
