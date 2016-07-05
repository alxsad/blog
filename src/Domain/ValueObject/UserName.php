<?php
namespace Alxsad\Domain\ValueObject;

class UserName
{
    private $firstName;
    private $lastName;

    public public function __construct(string $firstName, string $lastName)
    {
        if (!strlen($firstName)) {
            throw new \InvalidArgumentException("First name '$firstName' is invalid.");
        }
        if (!strlen($lastName)) {
            throw new \InvalidArgumentException("First name '$lastName' is invalid.");
        }
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    public static function fromString(string $userName): UserName
    {
        $data = explode(' ', $userName);
        if (2 == count($data)) {
            return new static($data[0], $data[1]);
        }
        throw new \InvalidArgumentException("User name '$userName' is invalid");
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function toString(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function __toString(): string
    {
        return $this->toString;
    }
}
