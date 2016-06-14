<?php
namespace Alxsad\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Post
{
    private $id;
    private $name;

    function __construct(string $name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
