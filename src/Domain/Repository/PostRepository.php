<?php
namespace Alxsad\Domain\Repository;

use Alxsad\Domain\Post;

interface PostRepository
{
    public function add(Post $post);

    public function get(string $id): Post;

    public function find(): array;
}
