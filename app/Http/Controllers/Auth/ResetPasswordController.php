<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //http://weibo.test/password/rest/3e59c791a359440292cf44fc9db5ca6f

    public function showResetForm($token) {
        return view('auth.password.reset')->with('token', $token);
    }

    public function reset(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
            'token' => 'required|min:31'
        ]);
        $token = $request->token;
        $email = $request->email;
        $has = PasswordReset::where('email', $email)->where('token', $token)->exists();
        if($has) {
            $user = User::where('email', $email)->first();
            if($user) {
                $user->password = bcrypt($request->password);
                $user->save();
                session()->flash('success', '修改成功');
                return redirect()->route('home');
            } else {
                session()->flash('danger', '数据错误');
                return redirect()->back()->withInput();
            }
        } else {
            session()->flash('danger', '链接错误，请重新申请修改');
            return redirect()->back()->withInput();
        }
    }
}
