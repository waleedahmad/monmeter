<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class suController extends Controller
{
    public function locationList(){

        $locations = DB::table('users')
                        ->where('role','=','admin')
                        ->join('user_details', 'users.id', '=', 'user_details.user_id')
                        ->get();
        return view('dashboard.super_users')
            ->with('active_tab','location-list')
            ->with('active_sidebar', 'super-users')
            ->with('locations', $locations);
    }

    public function createView($active){

        if($active === 'add-location'  || $active === 'location-list'){
            if($active === 'location-list'){
                $locations = DB::table('users')
                                ->where('role','=','admin')
                                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                                ->get();

                return view('dashboard.super_users')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'super-users')
                    ->with('locations', $locations);
            }
            return view('dashboard.super_users')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'super-users');
        }else{
            return redirect('/dashboard/manage/users');
        }
    }

    public function createLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'loc_name'  =>  'required',
            'date'  =>  'required|date',
            'name'  =>  'required',
            'job_position'  =>  'required',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|min:6',
            'static_ip' =>  'required',
            'mac'   =>  'required',
        ]);
        
        if($validator->passes()){
            $user = new User([
                'email'  =>  $request->input('email'),
                'password'  =>  bcrypt($request->input('password')),
                'role'  =>  'admin'
            ]);

            if($user->save()){
                $details = new UserDetail([
                    'user_id' =>  $user->id,
                    'location' =>  $request->input('loc_name'),
                    'added' =>  $request->input('date'),
                    'name' => $request->input('name'),
                    'job_position'  =>  $request->input('job_position'),
                    'static_ip' =>  $request->input('static_ip'),
                    'mac_address' => $request->input('mac')
                ]);

                if($details->save()){
                    return redirect('/dashboard/manage/users/location-list');
                }
            }
        }else{
            return $validator->errors()->all();
        }
    }
}
