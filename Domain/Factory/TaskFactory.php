<?php
require_once __DIR__ . '/../../Domain/Entity/Task.php';

final class TaskFactory
{
    public static function create(
        int $id,
        int $userId,
        string $contents,
        string $deadline,
        $category
    ): Task {
        return new Task(
            new TaskId($id),
            new UserId($userId),
            new TaskContents($contents),
            new DateTime($deadline),
            $category
        );
    }
}
