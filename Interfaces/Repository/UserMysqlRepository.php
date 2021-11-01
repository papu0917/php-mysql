<?php
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Domain/Factory/UserFactory.php';

final class UserMysqlRepository
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function insert(NewUser $user): void
    {
        $this->userDao->insert(
            $user->name()->value(),
            $user->email()->value(),
            $user->password()->hash()
        );
    }

    public function findByEmail(UserEmail $user): ?User
    {
        $userMapper = $this->userDao->findByEmail($user->value());

        if (is_null($userMapper)) {
            return null;
        }

        return UserFactory::create(
            $userMapper['id'],
            $userMapper['name'],
            $userMapper['email'],
            $userMapper['password']
        );
    }
}
