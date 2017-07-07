<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//引入验证码类
require_once app_path().'\Org\code\Code.class.php';
use App\Org\code\Code;

//第三方组件安装验证码
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Model\User;

class LoginController extends Controller
{
    //返回登录页面
    public function index()
    { 
        return view('admin.login');
    }
    //验证码
    
    public function code()
    {
        $code = new Code();
        return $code->make();
    }
    
    // 验证码生成
    /*
public function captcha($tmp)
{

    $phrase = new PhraseBuilder;
    // 设置验证码位数
    $code = $phrase->build(3);
    // 生成验证码图片的Builder对象，配置相应属性
    $builder = new CaptchaBuilder($code, $phrase);
    // 设置背景颜色
    $builder->setBackgroundColor(220, 210, 230);
    $builder->setMaxAngle(40);
    $builder->setMaxBehindLines(0);
    $builder->setMaxFrontLines(0);
    // 可以设置图片宽高及字体
    $builder->build($width = 100, $height = 40, $font = null);
    // 获取验证码的内容
    $phrase = $builder->getPhrase();
    // 把内容存入session
    \Session::flash('code', $phrase);
    // 生成图片
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Type:image/jpeg");
    $builder->output();
}
*/
    public function dologin()
    {
      //  dd(Input::all());
        //接受用户传过来的参数
        $input = Input::except('_token');
        $code = new Code;
        //$code = Session::get('code');
        //dd($code->get());
        //dd(strtoupper($input['code']));
        //dd($code);
        if(strtoupper($input['code']) != $code->get()){
            return back()->with('error','验证码错误');
        }


        //验证用户名
        $user = User::where('user_name',$input['user_name'])->first();
        if(!$user){
            return back()->with('error','此用户不存在');
        }
        //dd($input['user_name']);
        //dd(Session::all());
         //验证密码
       if($input['user_pass'] != Crypt::decrypt($user->user_pass)){
           return back()->with('error','密码不正确');
       }

        //重定向到后台首页
        return redirect('admin');
        //return 333;
        
    }
    public function crypt()
    {
        echo Crypt::encrypt('123456');
    }
}
