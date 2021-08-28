<?php
require_once __DIR__ . '/Dao.php';

final class TaskDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(
        int $userId,
        string $contents,
        DateTime $deadline,
        int $category_id
    ) {
        $sql = <<<EOF
            INSERT INTO 
                tasks 
            (user_id, contents, category_id, deadline) 
            VALUE 
            (:user_id, :contents, :category_id, :deadline)
EOF;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
        $stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $deadline->format('Y-m-d'), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findAllByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByDeadLineAsc(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0 ORDER BY deadline ASC");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByDeadLineDesc(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0 ORDER BY deadline DESC");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCategoryName(int $userId, string $name): array
    {
        $stmt = $this->pdo->prepare("SELECT tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0 and categories.name = '$name'");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        // $stmt->bindValue(':category', $name, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByTasks(int $userId, string $contents): array
    {
        $stmt = $this->pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where contents Like '%$contents%' and user_id = :user_id and status = 0");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $taskId): array
    {
        $sql = <<<EOF
        select 
            tasks.id, 
            tasks.user_id,
            tasks.contents, 
            tasks.deadline, 
            categories.name as categoryName
        from 
            tasks 
        left join 
            categories 
        on 
            tasks.category_id = categories.id 
        where 
            tasks.id = :taskId
EOF;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':taskId', $taskId, PDO::PARAM_INT);
        $res = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(
        int $id,
        string $contents,
        string $deadline,
        int $category_id
    ): bool {
        $stmt = $this->pdo->prepare("update tasks left join categories on tasks.category_id = categories.id set contents = :contents, deadline = :deadline, category_id = :category_id where tasks.id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateStatus(int $id, int $status): bool
    {
        $stmt = $this->pdo->prepare("update tasks set status = :status where tasks.id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
