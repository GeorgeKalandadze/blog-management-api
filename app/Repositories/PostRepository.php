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
            $post->id = $postData['id'];
            $post->title = $postData['title'];
            $post->body = $postData['body'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function getById(int $id): ?Post
    {
        $posts = $this->getAll();
        foreach ($posts as $post) {
            if ($post->id === $id) {
                return $post;
            }
        }
        return null;
    }

    public function store(array $data): array
    {
        Http::post("https://jsonplaceholder.typicode.com/posts", $data);

        return $this->getAll();
    }

    public function delete(int $id)
    {

    }

    private function fetchFromApi(string $endpoint): array
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/$endpoint");

        return $response->json();
    }
}
