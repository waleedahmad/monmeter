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
    return view('dashboard.dashboard');
});

// User Control
Route::get('/dashboard/user-control', function () {
    return view('dashboard.user_control');
});

// Manage Users
Route::get('/dashboard/manage/users', function () {
    return view('dashboard.super_users');
});

// Manage Super Users
Route::get('/dashboard/manage/super-users', function () {
    return view('dashboard.manage_super_users');
});


