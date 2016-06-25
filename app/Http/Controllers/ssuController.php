<?php

namespace App\Http\Controllers;

use App\Models\User;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class ssuController extends Controller
{
    /**
     * SSU Dashboard
     * @return mixed
     */
    public function superUsers(){
        $users = User::where('role','=','super')->get();
        return view('dashboard.manage_super_users')
            ->with('active_tab','users-list')
            ->with('active_sidebar', 'super-super-users')
            ->with('ssu_users', $users);
    }

    /**
     * SSU Dashboard Tabs
     * @param $active
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userView($active){
        if($active === 'add-user' || $active === 'users-list'){
            if($active === 'users-list'){
                $users = User::where('role','=','super')->get();
                return view('dashboard.manage_super_users')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'super-super-users')
                    ->with('ssu_users', $users);
            }

            return view('dashboard.manage_super_users')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'super-super-users');

        }else{
            return redirect('/dashboard/manage/super-users');
        }
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
        $email = $request->input('email');
        $user = User::where('email', '=', $email);
        if($user->count()){
            return response()->json(true);
        }
        return response()->json(false);
    }
}
