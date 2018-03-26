<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function create()
    {
    	return view('users.create');
    }

    public function show(User $user)
    {
    	return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {

    	//对用户提交的注册数据进行验证
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'email' => 'required|email|unique:users|max:255',
    		'password' => 'required|confirmed|min:6'

    	]);
    	//注册成功，保存到数据库
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

        Auth::login($user);
    	//flash() 只在下一次请求内有效
    	session()->flash('success', 'welcome!');

    	//route() 方法会自动获取 Model 的主键
    	//等同于 redirect()->route('users.show', [$user->id])
    	return redirect()->route('users.show', [$user]);
    }
}
