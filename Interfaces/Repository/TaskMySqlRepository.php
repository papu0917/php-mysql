<?php

require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../UseCase/Repository/TaskRepositoryInterface.php';
require_once __DIR__ . '/../../Domain/Entity/Task.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';

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

        $category = new Category(
            new CategoryId($taskMapper['categoryId']),
            new CategoryName($taskMapper['categoryName'])
        );

        return new Task(
            new TaskId($taskMapper['id']),
            new UserId($taskMapper['user_id']),
            new TaskContents($taskMapper['contents']),
            new DateTime($taskMapper['deadline']),
            $category
        );
    }

    public function insert(Task $task)
    {
        $category = $this->categoryDao->findById($task->categoryId());

        $this->taskDao->insert(
            $task->userId()->value(),
            $task->contents()->value(),
            $task->deadline(),
            $category['id']
        );
    }

    public function update(Task $task)
    {
        $category = $this->categoryDao->findById($task->categoryId());

        $this->taskDao->update(
            $task->userId()->value(),
            $task->contents()->value(),
            $task->deadline(),
            $category['id']
        );
    }

    public function delete(TaskId $id)
    {
        $this->taskDao->delete($id->value());
    }

    public function findAllByUserId(UserId $userId)
    {
        $taskMappers = $this->taskDao->findAllByUserId($userId->value());
        var_dump($taskMappers);
        die;

        // return new Task(
        //     new TaskId($taskMappers['id']),
        //     new UserId($taskMappers['user_id']),
        //     new TaskContents($taskMappers['contents']),
        //     new DateTime($taskMappers['deadline']),
        //     $taskMappers['categoryName']
        // );
    }
}
