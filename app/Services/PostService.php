<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\PostsRepositoryContract;

class PostService
{
    public function __construct(private readonly PostsRepositoryContract $postsRepositoryContract)
    {

    }

    public function getAll(): array
    {
        return $this->postsRepositoryContract->getAll();
    }

    public function getById(int $id): ?Post
    {
        return $this->postsRepositoryContract->getById($id);
    }

    public function store(array $data): void
    {
        $this->postsRepositoryContract->store($data);
    }

    public function delete(int $id): void
    {
        $this->postsRepositoryContract->delete($id);
    }
}
