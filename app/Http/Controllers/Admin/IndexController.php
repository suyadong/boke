<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    //
    public function index()
    {
    	return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }
    public function pass()
    {
    	return view('admin.pass');
    }
    public function dopass()
    {
    	//return view('admin.dopass');
    	//dd(input::all());
        $input = Input::except('_token');

         //原始密码必须输入，长度在6-18位
         //新密码必须跟确认密码一致
        $rule =[
            'password_o'=>'required|between:6,18',
            'password'=>'confirmed|between:6,20'
        ];
        $mess=[
            'password_o.required'=>'必须输入原始密码',
            'password_o.between'=>'原始密码必须在6-18位之间',
            'password.confirmed'=>'新密码跟确认密码不一致',
            'password.between'=>'新密码必须在6-20位之间',
        ];

//        Validator::make('要验证的数据','验证规则','提示信息的格式')


        $validator = Validator::make($input,$rule,$mess);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();

        }else{
            return back()
                ->with('errors','修改成功');
        }
    }
}
