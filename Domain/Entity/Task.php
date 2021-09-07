<?php
require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../../Domain/ValueObject/TaskContents.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../../Domain/Entity/Category.php';



final class Task
{
    private $id;
    private $userId;
    private $contents;
    private $deadline;
    private $category;

    public function __construct(
        ?TaskId $id,
        UserId $userId,
        TaskContents $contents,
        DateTime $deadline,
        ?Category $category
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->contents = $contents;
        $this->deadline = $deadline;
        $this->category = $category;
    }

    public function id(): ?TaskId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function contents(): TaskContents
    {
        return $this->contents;
    }

    public function deadline(): DateTime
    {
        return $this->deadline;
    }

    public function category(): ?Category
    {
        return $this->category;
    }

    public function categoryId(): int
    {
        return $this->category->id()->value();
    }

    public function categoryName(): string
    {
        return $this->category->name()->value();
    }

    public function isOverDeadline(): bool
    {
        $now = new DateTime();
        return ($this->deadline < $now);
    }
}
