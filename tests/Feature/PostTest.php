<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Services\PostService;
use App\Repositories\Contracts\PostsRepositoryContract;
use Mockery;

class PostTest extends TestCase
{
    public function testIndex()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);
        $mockRepository->shouldReceive('getAll')->andReturn([]);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);
        $mockRepository->shouldReceive('store')->andReturn(null);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'userId' => 1
        ]);

        $response->assertStatus(200);
    }

    public function testShow()
    {

        $mockRepository = Mockery::mock(PostsRepositoryContract::class);
        $mockRepository->shouldReceive('getById')->andReturn(['id' => 1, 'title' => 'Test Post', 'body' => 'Test Body']);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $response = $this->get('/posts/1');

        $response->assertStatus(200);

        $response->assertViewHas('post', ['id' => 1, 'title' => 'Test Post', 'body' => 'Test Body']);
    }

    public function testDestroy()
    {
        $mockRepository = Mockery::mock(PostsRepositoryContract::class);

        $postService = new PostService($mockRepository);

        $this->app->instance(PostService::class, $postService);

        $mockRepository->shouldReceive('delete')->once()->with('1');

        $response = $this->delete('/posts/1');

        $response->assertStatus(200);

        $response->assertExactJson(['post deleted successfully']);
    }
}

