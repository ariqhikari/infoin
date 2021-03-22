<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Mail;
use App\Mail\MailVerifyEMail;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::findOrFail($request->id);

        $tokenVerify = \Str::random(40);
        $user->update([
            'token' => $tokenVerify
        ]);

        Mail::to($user)->send(new MailVerifyEMail($tokenVerify, $user));

        return response()->json([
            "message" => "Email verified successfully!",
            "success" => true
        ]);
    }

    public function confirm($token)
    {
        $user = User::where('token', $token)->first();

        $user->update([
            'email_verified_at' => now()
        ]);

        $token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            "message" => "Email verified successfully!",
            "success" => true,
            "token" => $token,
        ]);
    }
}
