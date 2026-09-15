<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function send(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Invalid email address.'
            ]);
        }

        $otp = rand(100000, 999999);

        Otp::where('user_id', $user->id)->delete();

        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail((string) $otp));

        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.verify.form');
    }

    public function show()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $otp = Otp::where('user_id', session('otp_user_id'))
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Invalid or expired OTP.'
            ]);
        }

        Auth::loginUsingId($otp->user_id);

        $otp->delete();

        session()->forget('otp_user_id');

        return redirect()->route('dashboard');
    }
}