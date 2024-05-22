<?php

namespace App\Repositories\Contracts;

interface PostsRepositoryContract
{
    public function getAll();

    public function getById(int $id);

    public function store(array $data);

    public function delete(int $id);
}
