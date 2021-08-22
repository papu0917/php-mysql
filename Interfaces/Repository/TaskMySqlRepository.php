<?php

require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../UseCase/Repository/TaskRepositoryInterface.php';
require_once __DIR__ . '/../../Domain/Entity/Task.php';

final class TaskMySqlRepository implements TaskRepositoryInterface
{
    private $taskDao;

    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    public function findById(TaskId $id): Task
    {
        $taskMapper = $this->taskDao->findById($id->value());

        $taskId = new TaskId($taskMapper['id']);
        return new Task(
            $taskId,
            $taskMapper['contents'],
            new DateTime($taskMapper['deadline']),
            $taskMapper['categoryName']
        );
    }
}
