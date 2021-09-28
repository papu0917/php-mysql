<?php

require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../UseCase/Repository/TaskRepositoryInterface.php';
require_once __DIR__ . '/../../Domain/Entity/Task.php';
require_once __DIR__ . '/../../Domain/ValueObject/UserId.php';
require_once __DIR__ . '/../../categoryFactory.php';
require_once __DIR__ . '/../../TaskFactory.php';

final class TaskMySqlRepository implements TaskRepositoryInterface
{
    private $taskDao;
    private $categoryDao;

    public function __construct()
    {
        $this->taskDao = new TaskDao();
        $this->categoryDao = new CategoryDao();
    }

    // TODO category_idとcategory_nameがundefindな件
    public function findById(TaskId $id): Task
    {
        $taskMapper = $this->taskDao->findById($id->value());

        $category = CategoryFactory::create(
            $taskMapper['category_id'],
            $taskMapper['category_name']
        );

        $task = TaskFactory::create(
            $taskMapper['id'],
            $taskMapper['user_id'],
            $taskMapper['contents'],
            $taskMapper['deadline'],
            $category
        );

        return $task;
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

    public function findAllByUserId(TaskId $id)
    {
        $taskMappers = $this->taskDao->findAllByUserId($id->value());

        $tasks = [];
        foreach ($taskMappers as $taskMapper) {
            $category = CategoryFactory::create(
                $taskMapper['category_id'],
                $taskMapper['category_name']
            );

            // TODO ファクトリーにする
            $tasks[] = TaskFactory::create(
                $taskMapper['id'],
                $taskMapper['user_id'],
                $taskMapper['contents'],
                $taskMapper['deadline'],
                $category
            );
        }
        return $tasks;
    }
}
