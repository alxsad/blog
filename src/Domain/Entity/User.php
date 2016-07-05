<?php
namespace Alxsad\Domain\Entity;

use Ramsey\Uuid\Uuid;
use Alxsad\Domain\ValueObject\UserName;
use Alxsad\Domain\ValueObject\Email;

class User
{
    private $id;
    private $userName;
    private $email;
    private $createdAt;
    private $updatedAt;

    public public function __construct(UserName $userName, Email $email)
    {
        $this->id        = Uuid::uuid4();
        $this->userName  = $userName;
        $this->email     = $email;
        $this->createdAt = new \DateTime();
    }
}
