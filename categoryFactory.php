<?php
require_once __DIR__ . '/Domain/Entity/Category.php';

class CategoryFactory
{
    public static function create($id, $name)
    {
        return new Category($id, $name);
    }
}
