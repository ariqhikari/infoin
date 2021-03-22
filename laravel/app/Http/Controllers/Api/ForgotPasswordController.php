<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Mail;
use App\Mail\MailResetPassword;

class ForgotPasswordController extends Controller
{

    public function sendPasswordResetLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = Str::random(40);
        $user->update([
            'token' => $token
        ]);

        Mail::to($user)->send(new MailResetPassword($token));
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'Password reset email sent.',
            'data' => $response
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email could not be sent to this email address.']);
    }

    public function callResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return $this->resetPassword($user, $request->password);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }

    public function getDataUser($token)
    {
        $user = User::where('token', $token)->first();

        if ($user) {
            return response()->json(['status' => 'success', 'data' =>
            $user->email], 200);
        } else {
            return response()->json(['status' => 'failed']);
        }
    }
}
