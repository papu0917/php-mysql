<?php

require_once __DIR__ . '/../../Domain/Entity/Task.php';

interface TaskRepositoryInterface
{
    public function findById(TaskId $id): Task;
}
