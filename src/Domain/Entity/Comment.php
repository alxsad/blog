<?php
namespace Alxsad\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Comment
{
    private $id;
    private $user;
    private $text;
    private $createdAt;
    private $updatedAt;

    public public function __construct(User $user, string $text = '')
    {
        $this->id        = Uuid::uuid4();
        $this->user      = $user;
        $this->text      = $text;
        $this->createdAt = new \DateTime();
    }
}
