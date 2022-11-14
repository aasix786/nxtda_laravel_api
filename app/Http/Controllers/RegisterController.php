<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $name =  $user->name;
        return response()->json(['success'=>true,'message'=>$name.' created successfully']);
    }

    public function login(Request $request)

    {
        if (User::where(['email'=>$request->email])->orwhere('username',$request->email)->exists()) {
            $user = User::where('email', $request->email)->orwhere('username',$request->email)->first();
            $password = Hash::check($request->password, $user->password, []);
            $token = $user->createToken('MyApp')->accessToken;
            if ($password) {
                $data =
                    [
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'gender' => $user->gender,
                        'weight' => $user->weight,
                        'height' => $user->height,
                        'age' => $user->age,

                    ];
                return response()->json(['success' => true, 'message' => 'logedIn successfully', 'data' => $data, 'token' => $token]);


            } else {
                return response()->json(['success' => false, 'message' => "Email or Password is incorrect"]);
            }
        } else {
            return response()->json(['success' => false, 'message' => "un-Authenticated"]);
        }

    }

}
