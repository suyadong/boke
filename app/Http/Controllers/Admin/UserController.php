<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::paginate(3);
        return view('admin.user.index',['data'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = Input::except('_token');
       // dd($input);
       $rule=[
            'user_name'=>'required|between:6,18',
            'user_pass'=>'required|between:6,18',
        ];

        $mess=[
            'user_name.required'=>'用户名必须输入',
            'user_name.between'=>'用户名在6到18位之间',
            'user_pass.required'=>'密码必须输入',
            'user_pass.between'=>'密码在6-18位之间',
        ];

       $validator =  Validator::make($input,$rule,$mess);
        if($validator->passes()){
            $input['user_pass']=Crypt::encrypt($input['user_pass']);
            $re = User::create($input);
            if($re){
                return redirect('admin/user');
            }else{
                return back()->with('errors','用户添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data =  User::where('user_id',$id)->first();
        return view('admin.user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       //dd($id);
       $user = User::find($id);
       $user->user_name = $request->input('user_name');
       //dd($user->user_name);
       $re = $user->save();
        if($re){
            return redirect('admin/user');
        }else{
            return back()->with('errors','用户修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $re =   User::where('user_id',$id)->delete();
      if($re){
          $data = [
              'status'=>0,
              'msg'=>'用户删除成功'
          ];
      }else{
          $data = [
              'status'=>1,
              'msg'=>'用户删除失败'
          ];
      }
      return $data;
    }
}
