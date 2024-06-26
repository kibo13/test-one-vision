<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\GetPostListRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(GetPostListRequest $request, PostRepositoryInterface $postRepository): JsonResponse
    {
        $posts = $postRepository->getAll($request->validated());

        return response()->json([
            'data' => [
                'posts' => PostResource::collection($posts)
            ]
        ]);
    }

    public function getPostsByDummyId(GetPostListRequest $request, $dummyId, PostRepositoryInterface $postRepository): JsonResponse
    {
        $posts = $postRepository->getPostsByDummyId($dummyId, $request->validated());

        return response()->json([
            'data' => [
                'posts' => PostResource::collection($posts)
            ]
        ]);
    }

    public function store(CreatePostRequest $request, PostRepositoryInterface $postRepository): JsonResponse
    {
        $postRepository->create($request->validated());

        return response()->json(['message' => 'Пост успешно создан'], 201);
    }

    public function update(UpdatePostRequest $request, $id, PostRepositoryInterface $postRepository): JsonResponse
    {
        $postRepository->update($id, $request->validated());

        return response()->json(['message' => 'Пост успешно обновлен']);
    }

    public function destroy($id, PostRepositoryInterface $postRepository): JsonResponse
    {
        $postRepository->delete($id);

        return response()->json(['message' => 'Пост успешно удалён']);
    }
}
