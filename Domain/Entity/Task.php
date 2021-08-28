<?php
require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';


final class Task
{
    private $id;
    private $userId;
    private $contents;
    private $deadline;
    // TODO: カテゴリーエンティティにする
    private $categoryName;

    public function __construct(
        ?TaskId $id,
        UserId $userId,
        string $contents,
        DateTime $deadline,
        string $categoryName
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->contents = $contents;
        $this->deadline = $deadline;
        $this->categoryName = $categoryName;
    }

    public function id(): ?TaskId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function contents(): string
    {
        return $this->contents;
    }

    public function deadline(): DateTime
    {
        return $this->deadline;
    }

    public function categoryName(): string
    {
        return $this->categoryName;
    }
}
