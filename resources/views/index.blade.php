<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="_token" content="{{csrf_token()}}">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/app.min.css">
</head>
<body>
<div class="wrapper">
    @yield('login-form')
    @yield('user-control')
    @yield('dashboard')

</div>
</body>
<script type="text/javascript" src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>
<script src="/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
@if(env('APP_ENV') === "local")
    <script type="text/javascript" src="/assets/js/app.js"></script>
@else
    <script type="text/javascript" src="/assets/js/app.min.js"></script>
@endif
</html>
