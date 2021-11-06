<?php

require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/../Interfaces/Repository/UserMySqlRepository.php';
require_once __DIR__ . '/UseCaseOutput/UserSignInUseCaseOutput.php';
require_once __DIR__ . '/UseCaseInterface/UsreSignInUseCaseInterface.php';

final class UserSignInFromAndroidUseCase implements UsreSignInUseCaseInterface
{
    private $userRepository;
    private $input;

    public function __construct(UserSignInUseCaseInput $input)
    {
        $this->userRepository = new UserMysqlRepository();
        $this->input = $input;
    }

    public function handler(): UserSignInUseCaseOutput
    {
        $user = $this->userRepository->findByEmail($this->input->email());

        if (is_null($user)) {
            return $this->createOutput(false);
        }

        if (isAndroid()) {
            //hogehoge()
        }

        if (!$user->verifyPassword($this->input->password())) {
            return $this->createOutput(false);
        }

        $this->saveSession($user);

        return $this->createOutput(true);
    }

    private function createOutput(bool $isSuccess): UserSignInUseCaseOutput
    {
        return new UserSignInUseCaseOutput($isSuccess);
    }

    private function saveSession(User $user): void
    {
        $session = Session::getInstance();
        $session->setAuth($user->id()->value(), $user->name()->value());
    }
}
