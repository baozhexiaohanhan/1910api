<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //注册接口
    public function reg(Request $request){
        $user_name=$request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordker = $request->input('passwordker');
        //验证密码不能大于6位
        $len = strlen($password);
        if($len<6){
            $response = [
                'erron'=>500,
                'msg'=>'密码不能小于6位'
            ];
            return $response;
        }
        //2次密码必须一致
        if($password !=$passwordker){
            $response = [
                'erron'=>5001,
                'msg'=>'密码不一致'
            ];
            return $response;
        }
        //用户是否存在

        $a=UserModel::where(['user_name'=>$user_name])->first();
        if($a){
            $response = [
                'errno'  => 5002,
                'msg'    => " 用户名已存在"
            ];
            return $response;
        }
        $a=UserModel::where(['email'=>$email])->first();
        if($a){
            $response = [
                'errno'  => 5003,
                'msg'    => " Email已存在"
            ];
            return $response;
        }
        //密码生成
        $password = password_hash($password,PASSWORD_BCRYPT);
        $data=[
            'user_name'=>$user_name,
            'email'=>$email,
            'password'=>$password,
            'reg_time'=>time()
        ];
        $res = UserModel::insert($data);
        if($res)
        {
            $response = [
                'errno'  => 0,
                'msg'    => "注册成功"
            ];

        }else{
            $response = [
                'errno'  => 5004,
                'msg'    => "注册失败"
            ];
        }

        return $response;
    }
}
