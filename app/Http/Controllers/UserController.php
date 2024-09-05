<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session('LoggedIn') == null){
            return redirect(route('user.login'));
        }
        return view('users.index');
    }

    public function login()
    {
        return view('users.login')->with(['login_error'=>""]);
    }

    public function loginproccess(Request $req){
        $req->validate([
            "username"=>"required",
            "password"=>"required"
        ]);

        $data = User::where([['username',$req['username']],['password',md5($req['password'])]])->first();

        if($data == null){
            return view('users.login')->with(['login_error'=>"Wrong password or username"]);
        }

        session(['LoggedIn'=>true]);
        session(['userId'=>$data['id']]);
        session(['username'=>$data['username']]);
        session(['fullname'=>$data['name']]);
        session(['password'=>$data['password']]);
        return redirect(route('user.index'));
    }

    public function logout(){
        session()->flush();
        return redirect(route('user.login'));
    }
}
