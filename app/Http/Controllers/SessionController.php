<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest', [
			'only' => ['create']
		]);
	}
	
    public function create()
    {
    	return view('sessions.create');
    }

    /*
    * Login
    */
    public function store(Request $request)
    {
    	$credentials = $this->validate($request, [
    		'email' => 'required|email|max:255',
    		'password' => 'required',
    	]);

    	if(Auth::attempt($credentials, $request->has('remember'))) {
            //验证用户是否激活
            if (Auth::user()->activated) {
                session()->flash('success', 'welcome!');
                return redirect()->intended(route('users.show', [Auth::user()]));    
            } else {
                Auth::logout();
                session()->flash('warning', "This Account wasn't activated, please confirm your email.");
                return redirect('/');
            }
    		
    	} else {
    		session()->flash('danger', 'incorrect email/password');
    		return redirect()->back();
    	}
    	
    }

    public function destroy()
    {
    	Auth::logout();
    	session()->flash('success', 'Logout');
    	return redirect('login');
    }
}
