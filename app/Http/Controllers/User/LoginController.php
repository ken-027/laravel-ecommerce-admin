<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function check(LoginRequest $request)
    {       
        $credintails = $request->only('email', 'password');

        $is_auth = Auth::attempt($credintails);
        // if(Auth::attempt($credintails)){
        //     return redirect()->route('account');
        // }
        
        // return back()->with('error','Invalid creadetails');        
 
        return response()->json([
            'is_auth' => $is_auth,
            'url' =>  route('account'),
        ]);

    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('account');
    }
}
