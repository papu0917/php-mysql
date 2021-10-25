<?php

require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/../Interfaces/Repository/UserMySqlRepository.php';

final class UserSignInUseCase
{
    private $userRepository;
    private $input;

    public function __construct(UserSignInUseCaseInput $input)
    {
        $this->userRepository = new UserMysqlRepository();
        $this->input = $input;
    }

    public function handler()
    {
        $userEmail = $this->userRepository->findByEmail(
            new UserEmail($this->input->email())
        );
        return $userEmail;
    }
}
