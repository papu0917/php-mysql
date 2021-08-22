<?php

require_once __DIR__ . '/../../Infrastructure/Dao/TaskDao.php';
require_once __DIR__ . '/../../UseCase/Repository/TaskRepositoryInterface.php';
require_once __DIR__ . '/../../Domain/Entity/Task.php';


final class TaskCsvRepository implements TaskRepositoryInterface
{
    private $taskDao;

    public function __construct()
    {
        $this->taskDao = new TaskDao();
    }

    public function findById(TaskId $id): Task
    {
        // ex. CSVからタスク情報を取得する処理になる
        $taskMapper = $this->taskDao->findById($id->value());

        return new Task(
            $taskMapper['id'],
            $taskMapper['contents'],
            new DateTime($taskMapper['deadline']),
            $taskMapper['categoryName']
        );
    }
}
