<?php

require_once(__DIR__ . '/../Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../Interfaces/Repository/TaskMySqlRepository.php';
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';

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

    public function handler(): Task
    {
        $category = $this->categoryRepository->findById(new CategoryId($this->input->categoryId()));

        $newTask = new Task(
            null,
            new UserId($this->input->userId()),
            new TaskContents($this->input->contents()),
            new DateTime($this->input->deadline()),
            $category
        );

        $taskId = $this->taskRepository->insert($newTask);
        return $this->taskRepository->findById($taskId);
    }
}
