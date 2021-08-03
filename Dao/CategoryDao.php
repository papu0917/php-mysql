<?php

final class CategoryDao
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
    }

    public function findByName()
    {
        $sql = "select * from categories where name = :name";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function insert(string $name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
