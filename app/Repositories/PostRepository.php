<?php
namespace App\Repositories;
use App\Repositories\Contracts\PostsRepositoryContract;
use Illuminate\Support\Facades\Http;

class PostRepository implements PostsRepositoryContract
{

    public function getAll(): array
    {
        return $this->fetchFromApi('posts');
    }

    public function getById(int $id): ?array
    {
        $posts = $this->getAll();
        foreach ($posts as $post) {
            if ($post['id'] === $id) {
                return $post;
            }
        }
        return null;
    }

    public function store(array $data)
    {
        Http::post("https://jsonplaceholder.typicode.com/posts", $data);

        return $this->getAll();
    }

    public function delete(int $id): void
    {

    }

    private function fetchFromApi(string $endpoint): array
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/$endpoint");

        return $response->json();
    }
}
