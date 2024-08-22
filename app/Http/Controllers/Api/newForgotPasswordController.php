<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class newForgotPasswordController extends Controller
{
    // Send OTP for password reset
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return ResponseHelper::errors(message: 'Email not found', statuscode:404);
        }

        $otp = rand(100000, 999999);
        $time = now();

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            ['otp' => $otp, 'updated_at' => $time]
        );

        $data['email'] = $user->email;
        $data['title'] = "OTP for Password Reset";
        $data['body'] = "Your OTP is: " . $otp;

        Mail::send('mail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        return ResponseHelper::success(message: 'OTP has been sent. Please verify your account to reset the password', data: [], statuscode:200);
    }

    // Verify OTP and reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('email', $request->email)
                                    ->where('otp', $request->otp)
                                    ->first();

        if (!$otpData) {
            return ResponseHelper::errors(message: 'Invalid OTP', statuscode:400);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Optionally, delete OTP entry after successful password reset
        $otpData->delete();

        return ResponseHelper::success(message: 'Password has been reset successfully', data: [], statuscode:200);
    }
}
