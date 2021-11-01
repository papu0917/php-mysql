<?php
// require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserEmail.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserPassword.php';

final class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(
        ?UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function id(): ?UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password->value());
    }
}
