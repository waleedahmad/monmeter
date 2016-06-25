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
        $clients = Client::where('admin_id','=',Auth::user()->id)->get();
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
                $clients = Client::where('admin_id','=',Auth::user()->id)->get();
                return view('dashboard.user_control')
                    ->with('active_tab',$active)
                    ->with('active_sidebar', 'user-control')
                    ->with('clients', $clients);
            }
            
            if($active === 'disabled-users'){
                $clients = Client::where('admin_id','=',Auth::user()->id)
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
            'access'   =>  'required',
        ]);

        if($validator->passes()){
            $access = ($request->input('access') === 'enabled') ? true : false;
            $client = new Client([
                'name'  =>  $request->input('name'),
                'company'   =>  $request->input('company'),
                'added'  =>  $request->input('date'),
                'card_tag'  =>  $request->input('card_identifier'),
                'enote' =>  $request->input('enote'),
                'access'    =>  $access,
                'admin_id' =>  Auth::user()->id
            ]);

            if($client->save()){
                return response()->json(true);
            }
        }else{
            return response()->json(false);
        }
    }

    /**
     * Edit Client
     * @param $id
     * @return mixed
     */
    public function editUser($id){
        $client = Client::where('id','=',$id)->first();
        return view('dashboard.user_control')
            ->with('active_tab','edit-user')
            ->with('active_sidebar', 'user-control')
            ->with('client', $client);
    }

    /**
     * Update Client
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Update User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request){
        $validator = Validator($request->all(), [
            'name'  =>  'required',
            'company'   =>  'required',
            'date'  =>  'required|date',
            'card_identifier'   =>  'required',
            'access'   =>  'required',
        ]);

        if($validator->passes()){
            $access = ($request->input('user_access') === 'enabled') ? true : false;
            $client = Client::where('id','=',$request->input('client_id'));
            if($client->update([
                'name'  =>  $request->input('name'),
                'company'   =>  $request->input('company'),
                'added'  =>  $request->input('date'),
                'card_tag'  =>  $request->input('card_identifier'),
                'enote' =>  $request->input('enote'),
                'access'    =>  $access,
                'admin_id' =>  Auth::user()->id
            ])){
                return response()->json(true);
            }
        }

        return response()->json(false);
    }

    /**
     * Check if user exists
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userExists(Request $request){
        $client = Client::where('card_tag','=',$request->input('tag'));

        if($client->count()){
            return response()->json(true);
        }

        return response()->json(false);
    }
}
