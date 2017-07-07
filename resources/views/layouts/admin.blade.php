<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('/admins/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('/admins/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('/admins/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admins/style/js/ch-ui.admin.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
</head>
<body style="background:#F3F3F4;">
	@section('content')
    
        @show
</body>
</html>