<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //validate form data
        $this->validate($request,
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:0'       
            ]
        
        );

        //attempt to login as admin
        
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //if successful then redirect to intended route or admin dasboard
            return redirect()->intended(route('admin.dashboard'));
        }

        //if unsuccessful then redirect back to login page with email and remember fields
        return redirect()->back()->with($request->only('email', 'remember'));

    }
}
