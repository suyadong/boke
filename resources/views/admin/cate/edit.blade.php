@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin')}}">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 修改用户
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
         <div class="result_title">
            <h3>快捷操作</h3>
            @if (session('errors'))
                <div class="mark">
                    <ul>
                            <li>{{ session('errors') }}</li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/user/create')}}"><i class="fa fa-plus"></i>添加用户</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/user/'.$data->user_id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    
                    <tr>
                        <th><i class="require">*</i>用户名：</th>
                        <td>
                            <input type="text" class="fa" name="user_name" value="{{$data->user_name}}" >
                            <span>18位之间的数字字母下滑线</span>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection   

