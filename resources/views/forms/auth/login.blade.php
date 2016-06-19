@extends('index')

@section('title')
    Login - Monmeter
@stop()

@section('login-form')
    <div class="login">

        <div class="form">

            {{--Logo--}}
            <div class="left">
                @include('svg.auth.login_icon')
            </div>

            {{--Login Form--}}
            <div class="right">
                <input type="text" class="email" placeholder="Email">
                <input type="text" class="password" placeholder="Password">
                <input type="button" class="login" value="Connect">
            </div>
        </div>
    </div>
@stop
