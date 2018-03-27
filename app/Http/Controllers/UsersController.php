<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
    	return view('users.create');
    }

    public function show(User $user)
    {
        $statuses = $user->statuses()
                            ->orderBy('created_at', 'desc')
                            ->paginate(30);
    	return view('users.show', compact('user', 'statuses'));
    }

    /*
    * registe
    */
    public function store(Request $request)
    {

    	//对用户提交的注册数据进行验证
    	$this->validate($request, [
    		'name' => 'required|max:50',
    		'email' => 'required|email|unique:users|max:255',
    		// 'password' => 'required|confirmed|min:6'
            'password' => 'required|confirmed'

    	]);
    	//注册成功，保存到数据库
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', 'Please check your registe email to validate');
        return redirect('/');
        //Auto login
        //Auth::login($user);
    	//flash() 只在下一次请求内有效
    	//session()->flash('success', 'welcome!');

    	//route() 方法会自动获取 Model 的主键
    	//等同于 redirect()->route('users.show', [$user->id])
    	//return redirect()->route('users.show', [$user]);
    }

    /*
    * Send confirmation to email
    */
    public function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to   = $user->email;
        $subject = 'Thank you for use this application, please confirm your email';

        Mail::send($view, $data, function($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    /*
    * confirm email
    */
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', 'Activated');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50', 
            // 'password' => 'nullable|confirmed|min:6'
            'password' => 'nullable|confirmed|min:6'

        ]);

        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', 'profile updated');
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', 'delete success');
        return back();
    }
}
