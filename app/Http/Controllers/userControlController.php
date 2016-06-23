<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class userControlController extends Controller
{
    public function userList(){
        $clients = Client::where('admin','=',Auth::user()->email)->get();
        return view('dashboard.user_control')
            ->with('active_tab','user-list')
            ->with('active_sidebar', 'user-control')
            ->with('clients', $clients);
    }

    public function userListView($active){
        if($active === 'user-list' || $active === 'add-user' || $active === 'disabled-users'){

            if($active === 'user-list'){
                $clients = Client::where('admin','=',Auth::user()->email)->get();
                return view('dashboard.user_control')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'user-control')
                    ->with('clients', $clients);
            }
            
            if($active === 'disabled-users'){
                $clients = Client::where('admin','=',Auth::user()->email)
                                ->where('access','=',0)->get();
                return view('dashboard.user_control')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'user-control')
                    ->with('clients', $clients);
            }
            return view('dashboard.user_control')
                ->with('active_tab',$active)
                ->with('active_sidebar', 'user-control');

        }else{
            return redirect('/dashboard/user-control');
        }

    }

    public function createUser(Request $request){
        $validator = Validator($request->all(), [
            'name'  =>  'required',
            'company'   =>  'required',
            'date'  =>  'required|date',
            'card_identifier'   =>  'required',
            'user-access'   =>  'required',
        ]);

        if($validator->passes()){
            $access = ($request->input('user-access') === 'enabled') ? true : false;
            $client = new Client([
                'name'  =>  $request->input('name'),
                'company'   =>  $request->input('company'),
                'added'  =>  $request->input('date'),
                'card_tag'  =>  $request->input('card_identifier'),
                'enote' =>  $request->input('enote'),
                'access'    =>  $access,
                'admin' =>  Auth::user()->email
            ]);

            if($client->save()){
                return redirect('/dashboard/user-control/user-list');
            }
        }else{
            return redirect('/dashboard/user-control/add-user')
                ->withErrors($validator);
        }
    }
}
