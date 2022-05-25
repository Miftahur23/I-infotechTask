<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function doLogin(Request $request){
        // dd($request->all());
        $admin=$request->except('_token');
        //dd($admin);

        if(Auth::attempt($admin))
        {
            return redirect()->route('welcome');
        }
        else
        return redirect()->back()->withErrors('Invalid user credentials');

    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('loginpage');
    }
}
