<?php
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';

final class UserMysqlRepository
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function insert(User $user)
    {
        $this->userDao->insert(
            $user->name()->value(),
            $user->email()->value(),
            $user->password()->value()
        );
    }

    public function findByEmail(UserEmail $user)
    {
        $userMapper = $this->userDao->findByEmail($user->value());
        return $userMapper;
    }
}
