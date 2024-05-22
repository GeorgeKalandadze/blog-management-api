<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostsRepositoryContract;
use Illuminate\Support\Facades\Http;

class PostRepository implements PostsRepositoryContract
{
    public function getAll(): array
    {
        $postsData = $this->fetchFromApi('posts');
        $posts = [];

        foreach ($postsData as $postData) {
            $post = new Post();
            $post->fill($postData);

            $posts[] = $post;
        }

        return $posts;
    }

    public function getById(int $id): ?Post
    {
        $postData = $this->fetchFromApi("posts/$id");

        if ($postData) {
            $post = new Post();
            $post->fill($postData);
            return $post;
        }

        return null;
    }

    public function store(array $data): array
    {
        Http::post('https://jsonplaceholder.typicode.com/posts', $data);

        return $this->getAll();
    }

    public function delete(int $id)
    {
        Http::delete("https://jsonplaceholder.typicode.com/posts/$id");
    }

    private function fetchFromApi(string $endpoint): array
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/$endpoint");

        return $response->json();
    }
}
