<?php


Route::get('/login', function () {
    return view('forms.auth.login');
});

Route::get('/dashboard/main', function () {
    return view('dashboard.dashboard');
});

Route::get('/dashboard/user-control', function () {
    return view('dashboard.user_control');
});

Route::get('/dashboard/manage/users', function () {
    return view('dashboard.super_users');
});
