<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AgentAuthController extends Controller
{
    public function login(Request $req){
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',$req['email'])->get()->first();
        if($user){
            if(Hash::check($req['password'], $user->password)){
                if($user->role_id == 2){
                    $req->session()->put('agent_id',$user->id);
                    $req->session()->put('agent_name',$user->name);
                    $req->session()->put('agent_role',$user->role_id);
                    return redirect('/agent/dashboard');
                }else{
                    return back()->with('failed','you are not an authorized user for this action');
                }
            }else{
                return back()->with('failed','password does not match!');
            }
        }else{
            return back()->with('failed','please enter a registered email!');
        }
    }

    public function logout(){
        Session::forget('agent_id');
        Session::forget('agent_name');
        Session::forget('agent_role');
        return redirect('agent/signin');
    }
}
