<?php

namespace App\Modules\Users\Domain\Models;

use DateTime;

class User
{
    private string $id;

    private string $name;

    private string $email;

    private string $password;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function __construct(string $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public static function create(string $id, string $name, string $email, string $password): self
    {
        return new self($id, $name, $email, $password);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function updatePassword(string $hashedPassword): void
    {
        $this->password = $hashedPassword;
    }

    public function updateTimestamps(): void
    {
        $this->updatedAt = new DateTime();
    }

    public function getRoles(): array
    {
        return [];
    }
}