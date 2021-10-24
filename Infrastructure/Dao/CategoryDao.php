<?php
require_once __DIR__ . '/Dao.php';

final class CategoryDao extends Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(): array
    {
        $sql = "SELECT * from categories";
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        //         $sql = <<<EOF
        // SELECT 
        //     tasks.id,
        //     tasks.user_id,
        //     tasks.contents,
        //     tasks.deadline,
        //     categories.id as category_id, 
        //     categories.name as category_name 
        // from 
        //     tasks 
        // left join 
        //     categories 
        // on tasks.category_id = categories.id 
        // where 
        //     user_id = :user_id 
        //     and status = 0
        // EOF;
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        // $res = $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("select * from categories where id = :category_id");
        $stmt->bindValue(':category_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($category === false) ? null : $category;
    }

    public function findByName(string $name): ?array
    {
        $stmt = $this->pdo->prepare("select * from categories where name = :name");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($category === false) ? null : $category;
    }

    public function insert(string $name): int
    {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update(int $id, string $name): string
    {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = :name where id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $sql = <<<EOF
        DELETE FROM
            categories 
        WHERE 
            id = :id 
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
