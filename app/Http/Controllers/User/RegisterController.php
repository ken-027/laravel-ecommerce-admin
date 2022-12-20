<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {    
        $user = User::create([      
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),            
            'user_type' => user_type('member'),
        ]);
        
        return response()->json([
            'url' => route('account.login'),
            'user' => $user
        ]);       

    }
}
