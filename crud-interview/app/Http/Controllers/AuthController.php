<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return ['status'=>false,'message' => 'Invalid email or password'];

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $profile=User::find(Auth::user()->id);

        return ['status'=>true,'user'=>$profile,'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()

        ];
    }

    public function signup(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'name' => 'required',
        ]);
        if($request->password!=$request->repass){
            return ['status'=>false,'message'=>'Password do not match'];
        }
        $request['password']=bcrypt($request->password);
        $usee=User::create($request->all());
        return ['status'=>true,'message'=>'Account created successfully'];
    }

}
