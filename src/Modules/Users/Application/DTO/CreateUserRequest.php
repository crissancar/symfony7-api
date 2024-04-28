<?php

namespace App\Modules\Users\Application\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(min: 8, max: 100)]
    public string $password;


    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(string $name, string $email, string $password): CreateUserRequest
    {
        return new self($name, $email, $password);
    }
}