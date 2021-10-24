<?php
require_once __DIR__ . '/../Domain/Entity/Category.php';

final class AddCategoryResponseViewModel
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'status' => true,
            'data' => [
                'id' => $this->id(),
                'name' => $this->name()
            ]
        ];
    }

    private function id(): int
    {
        return $this->category->id()->value();
    }

    private function name(): string
    {
        return $this->category->name()->value();
    }
}
