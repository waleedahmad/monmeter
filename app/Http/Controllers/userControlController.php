<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class userControlController extends Controller
{
    /**
     * Client list
     * @return mixed
     */
    public function userList(){
        $clients = Client::where('admin','=',Auth::user()->email)->get();
        return view('dashboard.user_control')
            ->with('active_tab','user-list')
            ->with('active_sidebar', 'user-control')
            ->with('clients', $clients);
    }

    /**
     * Render UserControl tabs
     * @param $active
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Create new client
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createUser(Request $request){
        $validator = Validator($request->all(), [
            'name'  =>  'required',
            'company'   =>  'required',
            'date'  =>  'required|date',
            'card_identifier'   =>  'required',
            'user_access'   =>  'required',
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
                return response()->json(true);
            }
        }else{
            return response()->json(false);
        }
    }

    public function editUser($id){
        $client = Client::where('id','=',$id)->first();
        return view('dashboard.user_control')
            ->with('active_tab','edit-user')
            ->with('active_sidebar', 'user-control')
            ->with('client', $client);
    }

    public function updateAccess(Request $request){
        $client_id = $request->input('client');
        $access = $request->input('access');
        $access = ($access === 'enabled') ? true : false;

        $client = Client::where('id','=',$client_id);
        if($client->update([
            'access'    => $access
        ])){
            return response()->json(['updated'  =>   true]);
        }
    }

    public function updateUser(Request $request){
        $validator = Validator($request->all(), [
            'name'  =>  'required',
            'company'   =>  'required',
            'date'  =>  'required|date',
            'card_identifier'   =>  'required',
            'user-access'   =>  'required',
        ]);

        if($validator->passes()){
            $access = ($request->input('user-access') === 'enabled') ? true : false;
            $client = Client::where('id','=',$request->input('client-id'));
            if($client->update([
                'name'  =>  $request->input('name'),
                'company'   =>  $request->input('company'),
                'added'  =>  $request->input('date'),
                'card_tag'  =>  $request->input('card_identifier'),
                'enote' =>  $request->input('enote'),
                'access'    =>  $access,
                'admin' =>  Auth::user()->email
            ])){
                return redirect('/dashboard/user-control/user-list');
            }
        }else{
            return redirect('/dashboard/user-control/add-user')
                ->withErrors($validator);
        }
    }

    public function userExists(Request $request){
        $client = Client::where('card_tag','=',$request->input('tag'));

        if($client->count()){
            return response()->json(true);
        }

        return response()->json(false);
    }
}
