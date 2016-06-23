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
     * Create SSU User
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createUser(Request $request){
        $validator 	=	Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' =>  'required|min:6|same:password'
        ]);

        if($validator->passes()){
            $user = new User([
                'email'     =>  $request->input('email'),
                'password'  =>  bcrypt($request->input('password')),
                'role'      =>  'super'
            ]);

            if($user->save()){
                return redirect('/dashboard/manage/super-users/users-list');
            }
        }else{
            return redirect('/dashboard/manage/super-users/add-user')
                ->withErrors($validator->errors()->all())
                ->with('global', 'Form Validation Errors');
        }
    }
}
