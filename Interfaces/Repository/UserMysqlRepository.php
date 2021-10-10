<?php
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
// require_once __DIR__ . '/../../Domain/Entity/NewUser.php';
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

    public function findByEmail(UserEmail $user)
    {
        $userMapper = $this->userDao->findByEmail($user->value());
        return $userMapper;
        // var_dump($userMapper);
        // die;

        // if (is_null($userMapper)) {
        //     return null;
        // }

        // return UserFactory::create(
        //     $userMapper['id'],
        //     $userMapper['name'],
        //     $userMapper['email'],
        //     $userMapper['password']
        // );
    }
}
