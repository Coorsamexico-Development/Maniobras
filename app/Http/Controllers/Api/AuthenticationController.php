<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required', 'max:60']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = empty($errors->first('username')) ?
                $errors->first('password')
                : $errors->first('username');
            return response()->json([
                'message' => $firstError,
                'errors' => $validator->errors()
            ], 422);
        }
        $userLogin = $validator->validated();

        $user = User::firstWhere('name',  $userLogin['username']);

        if (!$user || !Hash::check($userLogin['password'], $user->password)) {
            return response()->json([
                'errors' => [__('auth.failed')],
                'message' => __('auth.failed')
            ], 422);
        }
        if (!$user->active) {
            return response()->json([
                'errors' => [__('auth.lock')],
                'message' => __('auth.lock')
            ], 422);
        }



        $apiToken = $user->createToken('auth_token')->plainTextToken;
        return UserResource::make($user)->additional([
            'meta' => [
                'apiToken' => $apiToken
            ]
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'data' => [],
            'links' => $request->url()
        ]);
    }

    public function validToken(Request $request)
    {
        return UserResource::make($request->user())->additional([
            'meta' => [
                'apiToken' => explode('Bearer ', $request->header('Authorization'))[1]
            ]
        ]);
    }
}
