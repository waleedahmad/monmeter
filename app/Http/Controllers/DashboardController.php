<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function realTime(){
        return view('dashboard.dashboard')
            ->with('active_tab','real-time')
            ->with('active_sidebar', 'main');
    }

    public function createView($active){

        if($active === 'real-time' || $active === 'last-reading' || $active === 'log-history'){
            return view('dashboard.dashboard')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'main');
        }else{
            return redirect('/dashboard/main');
        }

    }
}
