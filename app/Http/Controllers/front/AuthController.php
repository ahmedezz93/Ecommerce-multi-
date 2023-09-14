<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\front\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {

        return view('site.auth.login');
    }


    public function loginUser(UserLoginRequest $request)
    {

        $request->validated();
        
        if (auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('home');

        } else {
            return redirect()->route('user.login');
        }
    }

    public function register()
    {

        return view('site.auth.register');
    }


    public function registerUser(Request $request)
    {

        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return view('site.auth.login');
    }
}
