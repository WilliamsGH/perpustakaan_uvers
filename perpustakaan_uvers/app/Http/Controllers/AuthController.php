<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login($email, $password)
    {
        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $email, 'password' => $password])) {
            $user = Auth::user();
            if ($user->role == 'super_admin' or $user->role == 'admin') {
                $token = $user->createToken('authToken')->accessToken;
                // LoginHistory::create([
                //     'user_id' => $user->id,
                // ]);
                return ['error' => '','data' => ['token' => $token]];
            }

        } 

        return ['error' => 'Unauthorized', 'message' => 'Invalid User or Password', 'data' => []];
        
    }

    public function logout(User $user)
    {
        // Revoke the user's current token
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return ['error' => '', 'data' => []];
    }

    
    public function get_user_info()
    {
        $user = Auth::user();

        return new JsonResponse([
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'error' => ''
        ]);
    }

    public function get_wish_list()
    {
        $user = Auth::user();
        $wish_lists = $user->wish_lists;

        return new JsonResponse([
            'data' => [
                'wish_lists' => $wish_lists,
            ],
            'error' => ''
        ]);
    }

}
