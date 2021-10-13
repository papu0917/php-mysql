<?php
// require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserEmail.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserPassword.php';

final class NewUser
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        UserName $name,
        UserEmail $email,
        UserPassword $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
}
