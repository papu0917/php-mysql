<?php

final class DeleteCategoryUseCaseOutput
{
    private $isSuccess;
    private $message;
    private $redirectPath;

    public function __construct(bool $isSuccess, string $message, string $redirectPath)
    {
        $this->isSuccess = $isSuccess;
        $this->message = $message;
        $this->redirectPath = $redirectPath;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function redirectPath(): string
    {
        return $this->redirectPath;
    }
}
