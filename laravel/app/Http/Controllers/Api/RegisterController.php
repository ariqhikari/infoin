<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Mail;
use App\Mail\MailVerifyEMail;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $number = rand(1, 5);
        $tokenVerify = Str::random(40);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => \Str::slug($request->name) . "-" . \Str::random(5),
            'avatar' => 'assets/profile/avatar-' . $number . '.jpg',
            'role_id' => 1,
            'status' => 0,
            'token' => $tokenVerify
        ]);


        Mail::to($user)->send(new MailVerifyEMail($tokenVerify, $user));

        $response = [
            'success'   => true,
            'user'      => $user,
        ];

        return response($response, 201);
    }
}
