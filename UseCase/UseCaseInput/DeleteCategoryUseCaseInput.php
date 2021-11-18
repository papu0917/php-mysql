<?php

final class DeleteCategoryUseCaseInput
{
    private $categoryId;
    private $userId;

    public function __construct(int $categoryId, int $userId)
    {
        $this->categoryId = $categoryId;
        $this->userId = $userId;
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}
