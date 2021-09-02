<?php

require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../UseCase/Repository/TaskRepositoryInterface.php';
require_once __DIR__ . '/../../Domain/Entity/Task.php';

final class TaskMySqlRepository implements TaskRepositoryInterface
{
    private $taskDao;
    private $categoryDao;

    public function __construct()
    {
        $this->taskDao = new TaskDao();
        $this->categoryDao = new CategoryDao();
    }

    public function findById(TaskId $id): Task
    {
        $taskMapper = $this->taskDao->findById($id->value());

        return new Task(
            new TaskId($taskMapper['id']),
            new UserId($taskMapper['user_id']),
            new TaskContents($taskMapper['contents']),
            new DateTime($taskMapper['deadline']),
            $taskMapper['categoryName']
        );
    }

    public function insert(Task $task)
    {
        $category = $this->categoryDao->findById($task->categoryName());

        $this->taskDao->insert(
            $task->userId()->value(),
            $task->contents()->value(),
            $task->deadline(),
            $category['id']
        );
    }

    public function update(Task $task)
    {
        $category = $this->categoryDao->findById($task->categoryName());

        $this->taskDao->update(
            $task->userId()->value(),
            $task->contents()->value(),
            $task->deadline(),
            $category['id']
        );
    }
}
