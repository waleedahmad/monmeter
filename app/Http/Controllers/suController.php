<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class suController extends Controller
{
    /**
     * Super user clients list
     * @param Request $request
     * @return mixed
     */
    public function locationList(Request $request){
        return $this->generateView('location-list', $request);
    }

    /**
     * Render manage super users view
     * @param $active
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createView($active, Request $request){

        if($active === 'add-location'  || $active === 'location-list'){
            if($active === 'location-list'){
                return $this->generateView($active, $request);
            }
            return view('dashboard.super_users')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'super-users');
        }else{
            return redirect('/dashboard/manage/users');
        }
    }

    /**
     * Generate super_user view
     * @param $active
     * @param $request
     * @return mixed
     */
    protected function generateView($active, $request){
        return view('dashboard.super_users')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'super-users')
                    ->with('locations', $this->getLocations($request))
                    ->with('request', $request);
    }

    /**
     * Get Locations/Admins
     * @param $request
     * @return mixed
     */
    protected function getLocations($request){
        return DB::table('users')
                    ->where('role','=','admin')
                    ->orderBy('location', $this->getSortOrder($request))
                    ->where('user_details.admin_id', '=', Auth::user()->id)
                    ->join('user_details', 'users.id', '=', 'user_details.user_id')
                    ->paginate(10);
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
                        'user_details.added' =>  date_format(new \DateTime($request->input('date')), 'Y-m-d'),
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
                    'admin_id' =>  Auth::user()->id,
                    'location' =>  $request->input('loc_name'),
                    'added' =>  date_format(new \DateTime($request->input('date')), 'Y-m-d'),
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

    /**
     * Remove Location
     * @param Request $request
     * @return \Illuminate\Http\JsonRespons
     */
    public function removeLocation(Request $request){
        $id = $request->input('id');

        $clients = Client::where('admin_id','=',$id);
        $user_details = UserDetail::where('user_id','=',$id);
        $user = User::where('id','=', $id);

        $clients->delete();
        $user_details->delete();
        $user->delete();
        return response()->json(true);
    }

    /**
     * SU bypass admin redirect
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function bypassAdmin($id){
        session(['temp_admin' => $id]);
        return redirect('/dashboard/main');
    }

    /**
     * Get sort filter value
     * @param $request
     * @return string
     */
    protected function getSortOrder($request){
        return ($request->input('sort') === 'desc') ? 'DESC' : 'ASC';
    }
}
