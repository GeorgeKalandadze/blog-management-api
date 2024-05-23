<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Repositories\Contracts\PostsRepositoryContract;
use App\Services\PostService;
use Mockery;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testIndex()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);
        $mockRepository->shouldReceive('getAll')->andReturn([]);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->get('/api/posts');

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);
        $mockRepository->shouldReceive('store')->andReturn([]);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->post('/api/posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'userId' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertExactJson(['message' => 'Post created successfully']);
    }

    public function testShow()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);

        $post = new Post();
        $post->id = 1;
        $post->title = 'Test Post';
        $post->body = 'Test Body';

        $mockRepository->shouldReceive('getById')->andReturn($post);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->get('/api/posts/1');

        $response->assertStatus(200);

    }

    public function testDestroy()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $mockRepository->shouldReceive('delete')->once()->with('1');

        $response = $this->delete('/api/posts/1');

        $response->assertStatus(200);

        $response->assertExactJson(['message' => 'Post deleted successfully']);
    }
}
