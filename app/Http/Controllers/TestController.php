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

     //签名测试
     public function sign1(){
         $key = 'zxpsj$123';
        $data = 'hello word';
        $sign = sha1($data.$key);
        echo "要发送的数据:" .$data;echo '</br>';
        echo "发送前生成的签名:" .$sign; echo '<hr>';

        $b_url = 'http://www.1910.com/secret?data='.$data.'&sign='.$sign;
        echo $b_url;
     }
     public function secret(){
         $key = 'zxpsj$123';
         echo '<pre>';print_r($_GET);echo'</pre>';
        //收到数据 验证签名
         $data = $_GET['data'];
         $sign = $_GET['sign'];
         $local_sign = sha1($data.$key);
         echo '本地计算机签名: '.$local_sign;echo '<br>';
         if($sign == $local_sign){
             echo "通过";
         }else{
             echo "失败";
         }
     }

     
}
