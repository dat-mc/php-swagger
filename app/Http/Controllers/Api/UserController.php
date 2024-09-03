<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInUserRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *      name="Users",
 *      description="Работа с пользователями"
 * )
 */
class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *      path="/api/sign-in",
     *      tags={"Users"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SignInUserRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Вы вошли в аккаунт",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/UserResource"
     *              ),
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  description="Токен доступа"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Неверный email или пароль",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Неверный email или пароль"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Невалидные данные",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="The given data was invalid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The email field is required."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Произошла ошибка",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Error message"
     *              )
     *          )
     *      )
     * )
     */
    public function signIn(SignInUserRequest $signInUserRequest): JsonResponse
    {
        return $this->userService->signIn($signInUserRequest);
    }

    /**
     * @OA\Post(
     *      path="/api/sign-up",
     *      tags={"Users"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SignUpUserRequest")
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="Пользователь успешно создан",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/UserResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="Невалидные данные",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="The given data was invalid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The email field is required."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="Произошла ошибка",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Error message"
     *              )
     *          )
     *      )
     * )
     */
    public function signUp(SignUpUserRequest $signUpUserRequest): JsonResponse
    {
        return $this->userService->signUp($signUpUserRequest);
    }
}
