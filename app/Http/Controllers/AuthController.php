<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Authenticate Users
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(Request $request){
        if($request->isMethod('GET')){
            return view('forms.auth.login');
        }

        if($request->isMethod('POST')){
            $validator 	=	Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validator->passes()){
                $email 		= $request->input('email');
                $password 	= $request->input('password');

                if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    $user = Auth::user();
                    switch($user->role){
                        case 'super_super':
                            return redirect('/dashboard/manage/super-users');
                        case 'super':
                            return redirect('/dashboard/manage/users');
                        case 'admin':
                            return redirect('/dashboard/main');
                        default:
                            return redirect('/login');
                    }
                }

                return redirect('/login')
                    ->with('global', 'Incorrect Login Credentials');

            }else{
                return redirect('/login')
                    ->withErrors($validator->errors()->all())
                    ->with('global', 'Form Validation Errors');
            }
        }
    }

    /**
     * Logout Authenticated User
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
