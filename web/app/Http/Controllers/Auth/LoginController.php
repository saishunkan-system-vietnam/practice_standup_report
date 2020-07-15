<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//use Session;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin() {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth/login');
        }
    }

    public function postLogin(Request $request) {
        $rules = [
            'username' =>'required',
            'password' => 'required|min:6'
        ];
        $messages = [
            'username.required' => 'Tên người dùng là trường bắt buộc',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        } else {
            $username = $request->input('username');
            $password = $request->input('password');
            if( Auth::attempt(['username' => $username, 'password' =>$password])) {
                return redirect('/');
            } else {
                Session::flash('error', 'Tên người dùng hoặc mật khẩu không đúng!');
                return redirect('login');
            }
        }
    }

}
