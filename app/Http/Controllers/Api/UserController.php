<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\Model\TokenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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

    //登录
    public function login(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');
//        echo '用户输入密码:'.$password;echo '</br>';
        //验证登录信息
        $u = UserModel::where(['user_name'=>$user_name])->first();
//        echo '数据库密码：'.$u->password;echo '</br>';

        //验证密码
        $res = password_verify($password,$u->password);
        if($res){
            //生成token
            $str = $u->user_id . $u->user_name . time();
            $token = substr(md5($str),10,16) . substr(md5($str),0,18);
            //保存token，后验证使用
            $data = [
                'uid'=>$u->user_id,
                'token'=>$token
            ];
            TokenModel::insert($data);
            $response = [
                'errno'=>0,
                'msg'=>'ok',
                'token'=>$token
            ];
        }else{
            $response =[
                'errno'=>5005,
                'msg'=>'用户与密码不一致，请重新登录',
            ];
        }
        return $response;
        //d501360a7ed9f591
    }
    public function center()
    {
        //判断用户是否登录 ,判断是否有 uid 字段
        $token = $_GET['token'];
        //检查token是否有效
        $res = TokenModel::where(['token'=>$token])->first();
        if($res)
        {
            $uid = $res->uid;
            $user_info =UserModel::find($uid);
            //已登录
            echo $user_info->user_name."欢迎来到个人中心";
        }else{
            //未登录
            echo "请登录";
        }

    }

}
