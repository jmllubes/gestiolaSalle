<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function showLoginForm() {
        return view('auth.admin-login');
    }
    public function login(Request $request){
        // Validate the form data
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);
        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            // if successful, then redirect to their intended location
            return redirect()->intended(view('admin'));
        }
       
        
        // if unsuccessful, then redirect back to the login with the form data
        
        return redirect()->back()->withInput($request->only('email', 'remember'));
        
    }

    public function index() {
        return view('admin');
    }

}
