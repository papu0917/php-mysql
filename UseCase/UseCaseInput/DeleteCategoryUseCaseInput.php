<?php

final class DeleteCategoryUseCaseInput
{
    private $id;
    private $userId;

    public function __construct(int $id, int $userId)
    {
        $this->id = $id;
        $this->userId = $userId;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}
