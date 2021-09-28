<?php
require_once __DIR__ . '/Domain/Entity/Category.php';

class CategoryFactory
{
    public static function create(?int $id, ?string $name): ?Category
    {
        return (is_null($id))
            ? null
            : new Category(
                new CategoryId($id),
                new CategoryName($name)
            );
    }
}
