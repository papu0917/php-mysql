<?php

require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../Domain/Entity/Category.php';

final class CategoryMySqlRepository
{
    private $categoryDao;

    public function __construct()
    {
        $this->categoryDao = new CategoryDao();
    }

    public function insert(Category $category)
    {
        $this->categoryDao->insert($category->name()->value());
    }
}
