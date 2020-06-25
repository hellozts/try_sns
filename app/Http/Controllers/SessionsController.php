<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //
    public function create() {
        return view('sessions.create');
    }

    public function store(Request $request) {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials, $request->has('remember'))) {
            if(Auth::user()->activated) {
                session()->flash('success', '欢迎回来!');
                $fallback = route('users.show', Auth::user());
                return redirect()->intended($fallback);
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号还未激活，请检查邮箱中de注册邮件进行激活.');
                return redirect('/');
            }
        } else {
            session()->flash('danger', '很抱歉，您的邮箱或者密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destroy() {
        Auth::logout();
        session()->flash('success', '您已经成功退出登录');
        return redirect('login');
    }

    protected function sendEmailConfirmationTo($user) {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'hellozts@gmail.com';
        $name = 'hellozts';
        $to = $user->email;
        $subject = '感谢注册微博应用! 请确认你的邮箱';
        Mail::send($view, $data, function($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
