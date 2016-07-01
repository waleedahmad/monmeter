<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FuelLog;
use App\Models\TankLog;
use App\Models\User;
use App\Models\UserDetail;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class ssuController extends Controller
{
    /**
     * SSU Dashboard
     * @param Request $request
     * @return mixed
     */
    public function superUsers(Request $request){
        return $this->generateView('users-list', $request);
    }

    /**
     * SSU Dashboard Tabs
     * @param $active
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userView($active, Request $request){

        if($active === 'add-user' || $active === 'users-list'){
            if($active === 'users-list'){
                return $this->generateView($active, $request);
            }

            return view('dashboard.manage_super_users')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'super-super-users');

        }else{
            return redirect('/dashboard/manage/super-users');
        }
    }

    /**
     * Generate respective dashboard view
     * @param $active
     * @param $request
     * @return mixed
     */
    public function generateView($active, $request){
        return view('dashboard.manage_super_users')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'super-super-users')
                    ->with('ssu_users', $this->getSuperUsers($request))
                    ->with('request', $request);
    }

    /**
     * get Super users
     * @param $request
     * @return mixed
     */
    protected function getSuperUsers($request){
        return User::where('role','=','super')->orderBy('email',$this->getSortOrder($request))->paginate(10);
    }

    /**
     * get sort filter value
     * @param $request
     * @return string
     */
    protected function getSortOrder($request){
        return ($request->input('sort') === 'desc') ? 'DESC' : 'ASC';
    }

    /**
     * Edit SSU user view
     * @param $id
     * @return mixed
     */
    public function editUser($id){
        $user = User::where('id','=', $id)
                    ->where('role','=','super')->first();

        return view('dashboard.manage_super_users')
                    ->with('active_tab','edit-user')
                    ->with('active_sidebar', 'super-super-users')
                    ->with('su_user', $user);
    }

    /**
     * Update SSU user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request){
        $email = $request->input('email');
        $old_email = $request->input('old_email');
        $password = $request->input('password');

        $update = User::where('email','=',$old_email)->update([
            'email' =>  $email,
            'password'  =>  bcrypt($password)
        ]);

        if($update){
            return response()->json(true);
        }

        return response()->json(false);
    }

    /**
     * Create SSU User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createUser(Request $request){
        $validator 	=	Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->passes()){
            $user = new User([
                'email'     =>  $request->input('email'),
                'password'  =>  bcrypt($request->input('password')),
                'role'      =>  'super'
            ]);

            if($user->save()){
                return response()->json(true);
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
        $user = User::where('email', '=', $request->input('email'));
        if($user->count()){
            return response()->json(true);
        }
        return response()->json(false);
    }

    /**
     * Remove Super user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeUser(Request $request){

        $user = User::where('id','=', $request->input('id'))->first();

        $admins = User::where('user_details.admin_id', '=', $user->id)
                        ->join('user_details', 'user_details.user_id', '=', 'users.id');

        $client_ids = $admins->lists('user_details.user_id');

        FuelLog::whereIn('admin_id', $client_ids)->delete();
        TankLog::whereIn('admin_id', $client_ids)->delete();
        Client::whereIn('admin_id',$client_ids)->delete();
        UserDetail::where('admin_id', '=', $user->id)->delete();
        User::whereIn('id', $client_ids)->Delete();
        $admins->delete();

        if($user->delete()){
            return response()->json(true);
        }

        return response()->json(false);
    }
}
