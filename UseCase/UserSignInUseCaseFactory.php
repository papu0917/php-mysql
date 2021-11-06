<?php

require_once __DIR__ . '/UseCaseInterface/UserSignInUseCaseInterface.php';
require_once __DIR__ . '/UsreSignInFromWebUseCase.php';
require_once __DIR__ . '/UsreSignInFromAndroidUseCase.php';
require_once __DIR__ . '/UsreSignInFromIosUseCase.php';

final class UserSignInUseCaseFactory
{
    private $deviceType;

    public function __construct(string $deviceType)
    {
        $this->deviceType = $deviceType;
    }

    public function create(UserSignInUseCaseInput $input): UserSignInUseCaseInterface
    {
        if ($this->deviceType === 'Android') {
            return new UserSignInFromAndroidUseCase($input);
        }
        if ($this->deviceType === 'iOS') {
            return new UserSignInFromIosUseCase($input);
        }
        return new UserSignInFromWebUseCase($input);
    }
}
