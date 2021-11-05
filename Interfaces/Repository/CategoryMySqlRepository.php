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

    public function findById(CategoryId $id): Category
    {
        $categoryMapper = $this->categoryDao->findById($id->value());

        return new Category(
            new CategoryId($categoryMapper['id']),
            new CategoryName($categoryMapper['name'])
        );
    }

    public function insert(Category $category): CategoryId
    {
        $categoryId = $this->categoryDao->insert($category->name()->value());
        return new CategoryId($categoryId);
    }

    public function update(Category $category): void
    {
        $this->categoryDao->update(
            $category->id()->value(),
            $category->name()->value()
        );
    }

    public function delete(CategoryId $id): void
    {
        $this->categoryDao->delete($id->value());
    }
}
