<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'success'   => false,
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $tokenVerify = Str::random(40);
        $user->update([
            'token' => $tokenVerify
        ]);

        $token = $user->createToken('ApiToken')->plainTextToken;

        $response = [
            'success'   => true,
            'user'      => $user,
            'token'     => $token
        ];

        return response($response, 201);
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $user = User::where("id", $request->id)->first();
        $user->update([
            "status" => 0
        ]);

        \Auth::logout();

        return response()->json([
            'success'    => true
        ], 200);
    }
}
