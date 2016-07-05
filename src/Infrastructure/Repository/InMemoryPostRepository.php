<?php
namespace Alxsad\Infrastructure\Repository;

use Alxsad\Domain\Entity\Post;
use Alxsad\Domain\Repository\PostRepository;
use Functional as f;

class InMemoryPostRepository implements PostRepository
{
    private $posts;

    public function __construct()
    {
        $this->posts = [
            new Post('Hello world!'),
            new Post('Docker Docker Docker!'),
        ];
    }

    public function add(Post $post)
    {
        $this->posts[] = $post;
    }

    public function get(string $id): Post
    {
        $post = f\first($this->posts, function (Post $post) use ($id) {
            return $post->getId() == $id;
        });
        if ($post instanceof Post) {
            return $post;
        }
        throw new \InvalidArgumentException();
    }

    public function find(): array
    {
        return $this->posts;
    }
}
