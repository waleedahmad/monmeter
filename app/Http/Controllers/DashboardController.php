<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Client;
use App\Models\FuelLog;
use Carbon\Carbon;
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
                    ->with('logs', $this->getFuelLogs($request))
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
     * @param $request
     * @return mixed
     */
    protected function getFuelLogs($request){
        return FuelLog::where('fuel_logs.admin_id','=',$this->getAdminId())
                    ->join('clients', 'fuel_logs.client_id', '=', 'clients.id')
                    ->where('fuel_logs.created_at', '>', $this->getTime($request))
                    ->orderBy($this->getOrderByVal($request), $this->getSortOrder($request))
                    ->paginate(10);
    }

    protected function getTime($request){
        if($request->input('time')){
            $time = $request->input('time');
            $current = Carbon::now();
            switch ($time){
                case '24H':
                    return $current->subHours(24);
                case '7D':
                    return $current->subDays(7);
                case '30D':
                    return $current->subDays(30);
                case '60D':
                    return $current->subDay(60);
            }
        }
        return Carbon::create(2000,1,1,0);
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

    /**
     * get sort filter value
     * @param $request
     * @return string
     */
    protected function getOrderByVal($request){
        return ($request->input('orderBy')) ? $request->input('orderBy') : 'name';
    }

    /**
     * get sort filter value
     * @param $request
     * @return string
     */
    protected function getSortOrder($request){
        return ($request->input('sort') === 'desc') ? 'DESC' : 'ASC';
    }
}
