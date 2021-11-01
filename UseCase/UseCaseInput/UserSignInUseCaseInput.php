<?php

final class UserSignInUseCaseInput
{
    private $email;
    private $password;

    public function __construct(UserEmail $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
