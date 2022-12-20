<?php

namespace App\Http\Controllers\User;

use App\Models\PasswordReset;
use App\Mail\ClientForgetPassword;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sent(EmailRequest $request)
    {   

        $url = config('app.url') . 'user/reset-password/' . $request->_token;

        PasswordReset::create([
            'email' => $request->email,
            'token' => $request->_token,
        ]);
       
        Mail::to($request->email)->send(new ClientForgetPassword($url));

        return response()->json(['message' => 'Please check your email, we send link to your email']);
        return  back()->with('success', 'Please check your email, we send link to your email');
        
    }
}
