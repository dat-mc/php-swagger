<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\PostService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *      name="Posts",
 *      description="Работа с постами"
 * )
 */
class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @OA\Get(
     *      path="/api/posts",
     *      tags={"Posts"},
     *      @OA\Response(
     *          response="200",
     *          description="Посты успешно получены",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/PostResource")
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Unauthenticated."
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
    public function index(): JsonResponse
    {
        return $this->postService->index();
    }

    /**
     * @OA\Post(
     *      path="/api/post",
     *      tags={"Posts"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="Пост успешно создан",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PostResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Unauthenticated."
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
     *                      example="The title field is required."
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
    public function store(StorePostRequest $storePostRequest): JsonResponse
    {
        return $this->postService->store($storePostRequest);
    }

    /**
     * @OA\Get(
     *      path="/api/post/{id}",
     *      tags={"Posts"},
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Идентификатор поста",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Посты успешно получены",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PostResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Unauthenticated."
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
    public function show(int $id): JsonResponse
    {
        return $this->postService->show($id);
    }

    /**
     * @OA\Put(
     *      path="/api/post",
     *      tags={"Posts"},
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Идентификатор поста",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePostRequest")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Пост успешно обновлен",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/PostResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Unauthenticated."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Пост не найден",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="The post with the given ID was not found."
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
     *                      example="The title field is required."
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
    public function update(UpdatePostRequest $updatePostRequest): JsonResponse
    {
        return $this->postService->update($updatePostRequest);
    }

    /**
     * @OA\Delete(
     *      path="/api/post/{id}",
     *      tags={"Posts"},
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Идентификатор поста",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Пост успешно удален",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об успешной операции"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Ошибка авторизации",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="Unauthenticated."
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Пост не найден",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="Сообщение об ошибке",
     *                  example="The post with the given ID was not found."
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
    public function destroy(int $id): JsonResponse
    {
        return $this->postService->destroy($id);
    }
}
