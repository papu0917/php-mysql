<?php

final class AddCategoryUseCaseInput
{
    private $id;
    private $name;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
