<?php

require_once(__DIR__ . '/../Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../Interfaces/Repository/TaskMySqlRepository.php';
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/UseCaseOutput/AddTaskUseCaseOutput.php';
final class AddTaskUseCase
{
    private $taskRepository;
    private $categoryRepository;
    private $input;

    public function __construct(AddTaskUseCaseInput $input)
    {
        $this->taskRepository = new TaskMysqlRepository();
        $this->categoryRepository = new CategoryMySqlRepository();
        $this->input = $input;
    }

    public function handler(): AddTaskUseCaseOutput
    {
        $taskId = $this->createTask();
        $task = $this->taskRepository->findById($taskId);
        return new AddTaskUseCaseOutput($task);
    }

    private function createTask(): TaskId
    {
        $newTask = $this->newTask();
        return $this->taskRepository->insert($newTask);
    }

    private function newTask(): Task
    {
        $categoryId = new CategoryId($this->input->categoryId());
        $category = $this->categoryRepository->findById($categoryId);

        return new Task(
            null,
            new UserId($this->input->userId()),
            new TaskContents($this->input->contents()),
            new DateTime($this->input->deadline()),
            $category
        );
    }
}
