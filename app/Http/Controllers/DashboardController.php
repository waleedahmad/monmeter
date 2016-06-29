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

            $admin_id = (Auth::user()->role === 'super') ? session('temp_admin') : Auth::user()->id;

            if($active === 'log-history'){



                $logs = FuelLog::where('admin_id','=',$admin_id)->paginate(10);
                $count = 0;
                foreach ($logs as $log){
                    $client = $this->getClientDetails($log->client_id);
                    $logs[$count]->name = $client->name;
                    $logs[$count]->company = $client->company;
                    $logs[$count]->added = $client->added;
                    $logs[$count]->timestamp = $client->created_at;
                    $logs[$count]->access = $client->access;
                    $count++;
                }

                return view('dashboard.dashboard')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'main')
                    ->with('admin', $this->getAdminDetails())
                    ->with('logs', $logs)
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
     * Returns admin user details
     * @return mixed
     */
    public function getAdminDetails(){
        $admin_id = (Auth::user()->role === 'super') ? session('temp_admin') : Auth::user()->id;
        $user = DB::table('users')
            ->where('role','=','admin')
            ->where('user_details.user_id', '=', $admin_id)
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->first();
        return $user;
    }

    public function getClientDetails($client_id){
        return Client::where('id','=',$client_id)->first();
    }
}
