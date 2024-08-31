<?php

namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PostService extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Посты успешно получены',
                'data' => PostResource::collection(Post::all()),
            ],
            Response::HTTP_OK
        );
    }

    public function store(StorePostRequest $storePostRequest): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Пост успешно создан',
                'data' => PostResource::make(Post::create($storePostRequest->all())),
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Пост успешно получен',
                'data' => PostResource::make(Post::findOrFail($id)),
            ],
            Response::HTTP_OK
        );
    }

    public function update(UpdatePostRequest $updatePostRequest): JsonResponse
    {
        $post = Post::findOrFail($updatePostRequest->id);
        $post->update($updatePostRequest->all());
        return response()->json(
            [
                'message' => 'Пост успешно обновлен',
                'data' => PostResource::make($post),
            ],
            Response::HTTP_OK
        );
    }

    public function destroy(int $id): JsonResponse
    {
        Post::findOrFail($id)->delete();
        return response()->json(
            [
                'message' => 'Пост успешно удален',
            ],
            Response::HTTP_OK
        );
    }
}
