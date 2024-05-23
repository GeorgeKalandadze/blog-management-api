<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->getAll();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->postService->store($request->all());
        return response()->json(['message' => 'Post created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $post = $this->postService->getById($id);
        if ($post) {
            return response()->json($post);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $updated = $this->postService->update($id, $request->all());
        if ($updated) {
            return response()->json(['message' => 'Post updated successfully']);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->postService->delete($id);
        if ($deleted) {
            return response()->json(['message' => 'Post deleted successfully']);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
}
