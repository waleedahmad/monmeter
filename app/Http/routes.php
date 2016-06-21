<?php

/**
 * Authentication Routes
 */
Route::get('/login', function () {
    return view('forms.auth.login');
});

/**
 * Dashboard Routes
 */

// Main
Route::get('/dashboard/main', function () {
    return view('dashboard.dashboard')->with('active_tab','real-time')->with('active_sidebar', 'main');
});

Route::get('/dashboard/main/{active}', function ($active) {
    return view('dashboard.dashboard')->with('active_tab',$active)->with('active_sidebar', 'main');
});

// User Control
Route::get('/dashboard/user-control', function () {
    return view('dashboard.user_control')->with('active_tab','user-list')->with('active_sidebar', 'user-control');
});

Route::get('/dashboard/user-control/{active}', function ($active) {
    return view('dashboard.user_control')->with('active_tab',$active)->with('active_sidebar', 'user-control');
});

// Manage Users
Route::get('/dashboard/manage/users', function () {
    return view('dashboard.super_users')->with('active_tab','location-list')->with('active_sidebar', 'super-users');
});

Route::get('/dashboard/manage/users/{active}', function ($active) {
    return view('dashboard.super_users')->with('active_tab',$active)->with('active_sidebar', 'super-users');
});

// Manage Super Users
Route::get('/dashboard/manage/super-users', function () {
    return view('dashboard.manage_super_users')->with('active_tab','users-list')->with('active_sidebar', 'super-super-users');
});

Route::get('/dashboard/manage/super-users/{active}', function ($active) {
    return view('dashboard.manage_super_users')->with('active_tab',$active)->with('active_sidebar', 'super-super-users');
});


