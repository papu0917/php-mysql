<?php
require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../../Domain/ValueObject/TaskContents.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../../Domain/ValueObject/CategoryName.php';
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
        ?UserId $userId,
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

    public function userId(): ?UserId
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

    public function hasCategory(): bool
    {
        return !is_null($this->category);
    }

    // TODO 期限日が過ぎたら期限日の背景色を赤色にする
    public function isOverDeadline(): bool
    {
        $now = new DateTime();
        return ($this->deadline < $now);
    }
    // TODO 期限日が5日前になったら期限日の背景色を黄色にする
}
