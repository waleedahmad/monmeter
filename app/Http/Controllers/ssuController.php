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
     * @param Request $request
     * @return mixed
     */
    public function superUsers(Request $request){
        $order = ($request->input('sort') === 'desc') ? 'DESC' : 'ASC';
        $users = User::where('role','=','super')->orderBy('email',$order)->paginate(10);
        return view('dashboard.manage_super_users')
                    ->with('active_tab','users-list')
                    ->with('active_sidebar', 'super-super-users')
                    ->with('ssu_users', $users)
                    ->with('request', $request);
    }

    /**
     * SSU Dashboard Tabs
     * @param $active
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userView($active, Request $request){

        $order = ($request->input('sort') === 'desc') ? 'DESC' : 'ASC';

        if($active === 'add-user' || $active === 'users-list'){
            if($active === 'users-list'){
                $users = User::where('role','=','super')->orderBy('email',$order)->paginate(10);
                return view('dashboard.manage_super_users')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'super-super-users')
                    ->with('ssu_users', $users)
                    ->with('request', $request);
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

    public function removeUser(Request $request){
        $id = $request->input('id');

        $user = User::where('id','=', $id);

        if($user->delete()){
            return response()->json(true);
        }

        return response()->json(false);
    }
}
