<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdateProfileRequest;

class AccountController extends Controller
{
    public function index()
    {
       return view('user.sub-pages.account');
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function signup()
    {
        return view('user.auth.signup');
    }

    public function forgotPassword()
    {        
        return view('user.auth.forgot-password');
    }

    public function reset_password()
    {         
       
        $token = get_token(url()->current());       
        $token = PasswordReset::where('token', $token)->first();

        if (empty($token)) return  abort(404,'Page not found');
        
        if (now()->diff($token->created_at)->format('%I') > 60) return abort(404,'Page not found'); 
    
       
        return view('user.auth.reset-password')->with('email', $token->email);     
    }
    
    public function update(UpdateProfileRequest $request)
    {   
        $user = auth()->user();
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->phone =$request->phone;
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Profile Successfully Updated'
        ]);
    }

    public function update_profile_password(PasswordRequest $request)
    {       
    
        $user = auth()->user();
        $user->password = Hash::make($request->password);      
        $user->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Password Successfully Updated'
        ]);

    }

    public function update_address(AddressRequest $request)
    {
        $user = auth()->user();
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->postcode = $request->postcode;     
        $user->country = $request->country;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Address Successfully Updated'
        ]);


    }

  

    public function update_password(PasswordRequest $request)
    {        
        $user =  User::where('email', $request->email)->first();   
        $user->password = Hash::make($request->password);     
        $user->save();

        return response()->json([
        ]);
        
    }
    
}
