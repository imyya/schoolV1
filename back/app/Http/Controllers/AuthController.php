<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "email" => $request->email,
            "password" => $request->password,
            "role"=>$request->role,
            "grade"=>$request->grade,
            "specialite_id"=>$request->specialite_id
        ]);
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)

    {
        if (!Auth::attempt($request->only("email", "password"))) {
            return response([
                "message" => "Invalid credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }

        /** @var \App\Models\User $user **/  
        $user = Auth::user(); 
        $token = $user->createToken("token")->plainTextToken;
        $cookie = cookie("token", $token, 24 * 60);

        return response([
            "token" => $token,
            "user"=>$user,
        ])->withCookie($cookie);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout()
    {
        // Auth::logout();
        // Cookie::forget("token");

        // return response([
        //     "message" => "success"
        // ]);
       
/** @var \Laravel\Sanctum\HasApiTokens $user **/
$user = Auth::guard('sanctum')->user();
$user->tokens()->delete();    
}


}
