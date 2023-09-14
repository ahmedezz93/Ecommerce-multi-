<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {

        return Socialite::driver($provider)->redirect();
    }


    public function callback()
    {


        $user_provider = Socialite::driver('google')->user();
        dd($user_provider);


        $user = User::where('provider_id', $user_provider->id)->first();
        if (!$user) {

            user::create([
                'name' => $user_provider->name,
                'email' => $user_provider->email,
                'provider_token' => $user_provider->token,
                'provider_id'=>$user_provider->id,

            ]);
        }
        Auth::login($user);

        return redirect()->route('home');
    }
}
