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
            if($this->userValidation($request)->passes()){

                if($this->authenticateUser(
                    $request->input('email'),
                    $request->input('password')
                )){
                    $this->redirectAccordingRole(Auth::user());
                }

                return redirect('/login')
                    ->with('global', 'Incorrect Login Credentials');
            }else{
                return redirect('/login')
                    ->withErrors($this->userValidation($request)->errors()->all())
                    ->with('global', 'Form Validation Errors');
            }
        }
    }

    /**
     * Authenticate user
     * @param $email
     * @param $password
     * @return mixed
     */
    protected function authenticateUser($email, $password){
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * Redirect user to their respective dashboards
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirectAccordingRole($user){
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

    /**
     * User validator
     * @param $request
     * @return mixed
     */
    protected function userValidation($request){
        $validator 	=	Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return $validator;
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
