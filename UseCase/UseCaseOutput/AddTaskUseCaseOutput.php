<?php

final class AddTaskUseCaseOutput
{
	private $task;

	public function __construct(Task $task)
	{
		$this->task = $task;
	}

	public function task(): Task
	{
		return $this->task;
	}
}
