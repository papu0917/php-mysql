<?php
require_once __DIR__ . '/../Domain/Entity/Task.php';

final class AddTaskResponseViewModel
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'status' => true,
            'messages' => "登録できました",
            'data' => [
                'id' => $this->taskId(),
                'contents' => $this->contents(),
                'deadline' => $this->deadline(),
                'category' => [
                    'id' => $this->categoryId(),
                    'name' => $this->categoryName(),
                ]
            ]
        ];
    }

    private function taskId(): int
    {
        return $this->task->id()->value();
    }

    private function contents(): string
    {
        return $this->task->contents()->value();
    }

    private function deadline(): string
    {
        return $this->task->deadline()->format('Y-m-d');
    }

    private function categoryId(): int
    {
        return $this->task->categoryId();
    }

    private function categoryName(): string
    {
        return $this->task->categoryName();
    }
}
