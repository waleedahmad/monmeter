<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Client;
use App\Models\FuelLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Real time tab
     * @return mixed
     */
    public function realTime(){
        return view('dashboard.dashboard')
            ->with('active_tab','real-time')
            ->with('active_sidebar', 'main')
            ->with('admin', $this->getAdminDetails());
    }

    /**
     * Dashboard Tabs
     * @param $active
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createView($active, Request $request){
        if($active === 'real-time' || $active === 'last-reading' || $active === 'log-history'){

            if($active === 'log-history'){
                return view('dashboard.dashboard')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'main')
                    ->with('admin', $this->getAdminDetails())
                    ->with('logs', $this->getFuelLogs())
                    ->with('request',$request);
            }

            return view('dashboard.dashboard')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'main')
                ->with('admin', $this->getAdminDetails());
        }else{
            return redirect('/dashboard/main');
        }
    }

    /**
     * Get Fuel Logs
     * @return mixed
     */
    protected function getFuelLogs(){
        return FuelLog::with('client')->where('admin_id','=',$this->getAdminId())->paginate(10);
    }

    /**
     * Returns admin user details
     * @return mixed
     */
    protected function getAdminDetails(){
        $user = DB::table('users')
                    ->where('role','=','admin')
                    ->where('user_details.user_id', '=', $this->getAdminId())
                    ->join('user_details', 'users.id', '=', 'user_details.user_id')
                    ->first();
        return $user;
    }

    /**
     * get Admin id
     * @return mixed
     */
    protected function getAdminId(){
        return (Auth::user()->role === 'super') ? session('temp_admin') : Auth::user()->id;
    }
}
