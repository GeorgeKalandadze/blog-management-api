<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PostController extends Controller
{

    public function __construct(public PostService $postService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = $this->postService->getAll();
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->postService->store($request->all());
        return response()->json('post is created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $post = $this->postService->getById($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('post.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->postService->delete($id);
        return response()->json('post deleted successfully');
    }
}
