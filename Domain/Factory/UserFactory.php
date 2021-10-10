<?php
require_once __DIR__ . '/../../Domain/Entity/User.php';

final class UserFactory
{
    public static function create(
        ?int $id,
        string $name,
        string $email,
        string $password
    ): ?User {
        return new User(
            new UserId($id),
            new UserName($name),
            new UserEmail($email),
            new UserPassword($password)
        );
    }
}
