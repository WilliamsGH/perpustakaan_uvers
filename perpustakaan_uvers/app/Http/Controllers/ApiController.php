<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWishListRequest;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeleteWishListRequest;
use App\Http\Requests\ReturnBookRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Book;
use App\Models\BookMove;
use App\Models\LoginHistory;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->first();
        if(!$user || !Hash::check($data['password'], $user->password))
        {
            throw new HttpResponseException(response([
                'error' => [
                    'message' => 'Invalid Credentials'
                ]
            ], 401));
        }

        $accessToken = $user->createToken('AuthToken', ['expires_in' => 60 * 60])->plainTextToken;
        $refreshToken = $user->createToken('AuthTokenRefresh')->plainTextToken;
        
        LoginHistory::create([
            'user_id' => $user->id,
        ]);

        return new JsonResponse([
            'data' => [
                'name' => $user->name,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
            ],
            'error' => ''
        ]);
    }
}
