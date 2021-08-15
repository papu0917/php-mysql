<?php
require_once __DIR__ . '/Dao.php';

final class TaskDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(int $userId, string $contents, string $deadline, int $category_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, contents, category_id, deadline) VALUE (:user_id, :contents, :category_id, :deadline)");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
        $stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findByAll(int $userId)
    {
        $stmt = $this->pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0");

        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function edit(int $taskId)
    {
        $stmt = $this->pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where tasks.id = :taskId");
        $stmt->bindValue(':taskId', $taskId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, string $contents, string $deadline, int $category_id)
    {
        $stmt = $this->pdo->prepare("update tasks left join categories on tasks.category_id = categories.id set contents = :contents, deadline = :deadline, category_id = :category_id where tasks.id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateStatus(int $id, int $status)
    {
        $stmt = $this->pdo->prepare("update tasks set status = :status where tasks.id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
