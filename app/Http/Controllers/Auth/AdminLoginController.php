<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest:Admin');
    }
    public function showloginform(){
        return view('auth.adminlogin') ;
    }

    public function login(Request $request)
    {
        // validate the form data
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]
        );
        // Attempt to log the user in
        if(auth::guard('Admin')->attempt(['email' => $request->email , 'password' => $request->password],$request->remember))
        {
           // if successful then redirect to their intended location
         return redirect()->intended(route('admin.dashboard'));
        }
        

        //if unsuccessful , then redirect to login
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
