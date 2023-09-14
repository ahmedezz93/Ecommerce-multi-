<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(adminLoginRequest $request)
    {
        $request->validated();

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {

            return back();
        }
    }
}
