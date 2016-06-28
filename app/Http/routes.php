<?php

/**
 * Authentication Routes
 */

Route::group(['middleware'	=>	'guest'], function(){
    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@login');
});

/**
 * Dashboard Routes
 */

Route::group(['middleware'	=>	'auth'], function(){

    Route::get('/', function(){
        return redirect('/login');
    });

    Route::get('/logout', 'AuthController@logout');

    // Admin group
    Route::group(['middleware'  =>  'admin'], function(){
        // Main
        Route::get('/dashboard/main', 'DashboardController@realTime');
        Route::get('/dashboard/main/{active}', 'DashboardController@createView');

        // User Control
        Route::get('/dashboard/user-control', 'userControlController@userList');
        Route::post('/dashboard/user-control/update/access', 'userControlController@updateAccess');
        Route::post('/dashboard/user-control/update/', 'userControlController@updateUser');
        Route::post('/dashboard/user-control/create', 'userControlController@createUser');
        Route::get('/dashboard/user-control/exist', 'userControlController@userExists');
        Route::get('/dashboard/user-control/edit-user/{id}', 'userControlController@editUser');
        Route::get('/dashboard/user-control/{active}', 'userControlController@userListView');
    });

    // Super group
    Route::group(['middleware'  =>  'su'], function(){
        Route::get('/dashboard/manage/view/{id}', 'suController@bypassAdmin');
        Route::get('/dashboard/manage/users', 'suController@locationList');
        Route::get('/dashboard/manage/users/exists', 'suController@userExist');
        Route::post('/dashboard/manage/users/create', 'suController@createLocation');
        Route::post('/dashboard/manage/users/remove', 'suController@removeLocation');
        Route::get('/dashboard/manage/users/edit/{id}', 'suController@editLocation');
        Route::post('/dashboard/manage/users/update', 'suController@updateLocation');
        Route::get('/dashboard/manage/users/{active}', 'suController@createView');
        
        

    });

    // Super super group
    Route::group(['middleware'  =>  'ssu'], function(){
        Route::get('/dashboard/manage/super-users', 'ssuController@superUsers');
        Route::get('/dashboard/manage/super-users/exists', 'ssuController@userExist');
        Route::post('/dashboard/manage/super-users/create', 'ssuController@createUser');
        Route::post('/dashboard/manage/super-users/update', 'ssuController@updateUser');
        Route::post('/dashboard/manage/super-users/remove', 'ssuController@removeUser');
        Route::get('/dashboard/manage/super-users/edit-user/{id}', 'ssuController@editUser');
        Route::get('/dashboard/manage/super-users/{active}', 'ssuController@userView');
    });
});


Route::get('/api', 'FuelLogController@logger');


