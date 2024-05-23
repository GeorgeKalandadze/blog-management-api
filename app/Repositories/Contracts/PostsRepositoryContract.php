<?php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface PostsRepositoryContract
{
    public function getAll(): array;

    public function getById(int $id): ?Post;

    public function store(array $data): array;

    public function delete(int $id): void;
}
