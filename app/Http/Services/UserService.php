<?php

namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInUserRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserService extends Controller
{
    public function signIn(SignInUserRequest $signInUserRequest): JsonResponse
    {
        if (Auth::attempt([
            'email' => $signInUserRequest->email,
            'password' => $signInUserRequest->password
        ])) {
            $token = Auth::user()->createToken('bearerToken')->plainTextToken;
            Auth::guard('web')->logout();
            return response()->json(
                [
                    'message' => 'Вы вошли в аккаунт',
                    'data' => UserResource::make(
                        User::where('email', $signInUserRequest->email)->first()
                    ),
                    'token' => $token,
                ],
                Response::HTTP_OK,
                [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        } else {
            return response()->json(
                [
                    'message' => 'Неверный email или пароль',
                ],
                Response::HTTP_UNAUTHORIZED,
                [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function signUp(SignUpUserRequest $signUpUserRequest): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Пользователь успешно создан',
                'data' => UserResource::make(User::create($signUpUserRequest->all())),
            ],
            Response::HTTP_CREATED,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }
}
