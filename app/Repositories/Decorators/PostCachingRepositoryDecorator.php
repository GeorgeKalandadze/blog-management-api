<?php

namespace App\Repositories\Decorators;
use App\Repositories\Contracts\PostsRepositoryContract;
use Illuminate\Support\Facades\Cache;

class PostCachingRepositoryDecorator implements PostsRepositoryContract
{

    public function __construct(public PostsRepositoryContract $postsRepository)
    {

    }

    public function getAll()
    {
        return Cache::remember('posts_all',300, function () {
            return $this->postsRepository->getAll();
        });
    }

    public function getById(int $id)
    {
        return $this->postsRepository->getById($id);
    }

    public function store(array $data)
    {
        $this->postsRepository->store($data);
        $this->clearCache('posts_all');
        return $this->getAll();
    }

    public function delete(int $id)
    {
       $this->postsRepository->delete($id);
    }


    private function clearCache($key)
    {
        Cache::forget($key);
    }
}
