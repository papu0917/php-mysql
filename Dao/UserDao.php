<?php

final class UserDao
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
    }

    public function findByEmail(string $email): array
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {
    }

    public function insert($name, $email, $passwordHash)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
