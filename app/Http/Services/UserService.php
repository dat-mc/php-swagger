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
    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            Auth::guard('web')->logout();
            Auth::user()->tokens()->delete();

            return response()->json(
                [
                    'message' => 'Вы вышли из аккаунта',
                ],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                [
                    'message' => 'Аккаунт не найден',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function signIn(SignInUserRequest $signInUserRequest): JsonResponse
    {
        if (Auth::attempt([
            'email' => $signInUserRequest->email,
            'password' => $signInUserRequest->password
        ])) {
            return response()->json(
                [
                    'message' => 'Вы вошли в аккаунт',
                    'data' => UserResource::make(
                        User::where('email', $signInUserRequest->email)->first()
                    ),
                ],
                Response::HTTP_OK,
                [
                    'Authorization' => 'Bearer ' . Auth::user()->createToken('bearerToken')->plainTextToken,
                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Неверный email или пароль',
                ],
                Response::HTTP_UNAUTHORIZED
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
            Response::HTTP_CREATED
        );
    }
}
