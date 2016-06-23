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
                <form action="/login" method="POST">
                    <input type="text" class="email" name="email" placeholder="Email">
                    <input type="password" class="password" name="password" placeholder="Password">
                    {{csrf_field()}}
                    <input type="submit" class="login" value="Connect">
                </form>
            </div>
        </div>
    </div>
@stop
