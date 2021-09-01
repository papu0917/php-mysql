<?php
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../../Domain/ValueObject/CategoryName.php';

final class Category
{
    private $id;
    private $name;

    public function __construct(?CategoryId $id, CategoryName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): ?CategoryId
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }
}
