<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm() {
        return view('auth.password.email');
    }

    public function sendResetLinkEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user) {
            $token = PasswordReset::create([
                'email' => $user->email,
                'token' => md5(time() . $email . rand(1000,9999))
            ]);
            $this->sendEmailConfirmationTo($token, 'emails.forgot', '忘记密码');
            session()->flash('success', '邮件发送成功');
            return redirect()->route('home');
        } else {
            session()->flash('danger', '没有该email');
            return redirect()->route('password.request');
        }
    }
}
