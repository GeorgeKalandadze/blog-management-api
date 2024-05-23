<?php

namespace App\Repositories\Decorators;

use App\Models\Post;
use App\Repositories\Contracts\PostsRepositoryContract;
use Illuminate\Support\Facades\Cache;

class PostCachingRepositoryDecorator implements PostsRepositoryContract
{
    public function __construct(private readonly PostsRepositoryContract $postsRepository)
    {

    }

    public function getAll(): array
    {
        return Cache::remember('posts_all', 300, function () {
            return $this->postsRepository->getAll();
        });
    }

    public function getById(int $id): Post
    {
        return $this->postsRepository->getById($id);
    }

    public function store(array $data): array
    {
        $this->postsRepository->store($data);
        $this->clearCache('posts_all');

        return $this->getAll();
    }

    public function delete(int $id): void
    {
        $this->postsRepository->delete($id);
    }

    private function clearCache($key)
    {
        Cache::forget($key);
    }
}
