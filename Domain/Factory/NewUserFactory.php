<?php
require_once __DIR__ . '/../../Domain/Entity/NewUser.php';

final class NewUserFactory
{
    public static function create(
        string $name,
        string $email,
        string $password
    ): NewUser {
        return new NewUser(
            new UserName($name),
            new UserEmail($email),
            new UserPassword($password)
        );
    }
}
