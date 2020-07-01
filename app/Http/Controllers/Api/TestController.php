<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{

   public function info(){
       $key = '1910';
       $data = $_GET['data'];      //接收到的数据
       $sign = $_GET['sign'];      //接收到的签名
       $local_sign = sha1($data.$key);
       if($sign==$local_sign)
       {
           echo "验签成功";
       }else{
           echo "验签失败";
       }
   }
public function decrypt1(){
  $method = 'AES-256-CBC';
        $key = '1910';
        $iv = 'jiayonglonghello';
        $enc_data = $_POST['data'];
        $sign = $_POST['sign'];
        echo '<pre>';print_r($_POST);echo '</pre>';
        //验签 
        $local_sign = sha1($enc_data.$key);
        if($sign==$local_sign){
          echo "验签成功";echo '</br>';
          //解密
          $dec_data = openssl_decrypt($enc_data, $method, $key,OPENSSL_RAW_DATA,$iv);
          echo "解密的数据：". $dec_data;
        }else{
          echo "验签失败";
        }
     }
}
