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
    /**
     * Super user clients list
     * @return mixed
     */
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

    /**
     * Render manage super users view
     * @param $active
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Edit Location
     * @param $id
     * @return mixed
     */
    public function editLocation($id){
        $location = DB::table('users')
                        ->where('users.id', '=', $id)
                        ->join('user_details', 'users.id', '=', 'user_details.user_id')
                        ->first();
        return view('dashboard.super_users')
            ->with('active_tab','edit-location')
            ->with('active_sidebar', 'super-users')
            ->with('location', $location);
    }

    /**
     * Update Location
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLocation(Request $request){

        $update = DB::table('users')
                    ->where('users.id', '=', $request->input('user_id'))
                    ->join('user_details', 'users.id', '=', 'user_details.user_id')
                    ->update([
                        'users.email' =>  $request->input('email'),
                        'users.password'  =>  bcrypt($request->input('password')),
                        'user_details.location'  =>  $request->input('loc_name'),
                        'user_details.added' =>  $request->input('date'),
                        'user_details.name'  =>  $request->input('name'),
                        'user_details.job_position'  =>  $request->input('job_position'),
                        'user_details.static_ip' =>  $request->input('static_ip'),
                        'user_details.mac_address'   =>  $request->input('mac')
                    ]);

        if($update){
            return response()->json(true);
        }

        return response()->json(false);
    }

    /**
     * Create a new Client
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
                    return response()->json(true);
                }
            }
        }else{
            return response()->json(false);
        }
    }

    /**
     * Check if user exist
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userExist(Request $request){
        $email = $request->input('email');
        $user = User::where('email', '=', $email);
        if($user->count()){
            return response()->json(true);
        }
        return response()->json(false);
    }
}
