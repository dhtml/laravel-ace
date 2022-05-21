<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Validator;


class UserService
{
    /**
     * Authenticate user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function authenticate(LoginRequest $request)
    {
        $input = $request->only(['email', 'password']);

        if (auth()->attempt($input)) {
            $token = auth()->user()->createToken('passport_token')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'User login succesfully, Use token to authenticate.',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User authentication failed.'
            ], 401);
        }
    }

}
