<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function login(Request $req){
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',$req['email'])->get()->first();
        if($user){
            if(Hash::check($req['password'], $user->password)){
                if($user->role_id == 3){
                    $req->session()->put('user_id',$user->id);
                    $req->session()->put('name',$user->name);
                    $req->session()->put('role',$user->role_id);
                    return redirect('/user/lender');
                }else if($user->role_id == 4){
                    $req->session()->put('user_id',$user->id);
                    $req->session()->put('name',$user->name);
                    $req->session()->put('role',$user->role_id);
                    return redirect('/user/borrower');
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
        Session::forget('user_id');
        Session::forget('name');
        Session::forget('role');
        return redirect('/');
    }
}
