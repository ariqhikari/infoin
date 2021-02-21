<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        $url =  Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response([
            "url" => $url
        ], 201);
    }

    public function handleProviderCallback($provider)
    {
        $user =  Socialite::driver($provider)->stateless()->user();

        if (!$user->token) {
            // return json
            dd('failed');
        }

        $appUser = User::whereEmail($user->email)->first();

        if ($appUser) {
            $token = $appUser->createToken('ApiToken')->plainTextToken;
            
            \Auth::login($appUser);

            $response = [
                'success'   => true,
                'user'      => $appUser,
                'token'     => $token
            ];
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => md5($user->token),
                'token' => \Str::random(40),
                'avatar' => $user->avatar,
                "role_id" => 1,
                "status" => 0,
                "slug" => \Str::slug($user->name) . "-" . \Str::random(5),
                'email_verified_at' => now(),
                "blacklist" => 0
            ]);
            $token = $newUser->createToken('ApiToken')->plainTextToken;
            
            \Auth::login($newUser);

            $response = [
                'success'   => true,
                'user'      => $newUser,
                'token'     => $token
            ];
        }

        return response($response, 201);
    }
}
