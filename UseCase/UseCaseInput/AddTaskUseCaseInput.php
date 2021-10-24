<?php

final class AddTaskUseCaseInput
{
	private $userId;
	private $contents;
	private $deadline;
	private $categoryId;

	public function __construct(
		int $userId,
		string $contents,
		string $deadline,
		int $categoryId
	) {
		$this->userId = $userId;
		$this->contents = $contents;
		$this->deadline = $deadline;
		$this->categoryId = $categoryId;
	}

	public function userId(): int
	{
		return $this->userId;
	}

	public function contents(): string
	{
		return $this->contents;
	}

	public function deadline(): string
	{
		return $this->deadline;
	}

	public function categoryId(): int
	{
		return $this->categoryId;
	}
}
