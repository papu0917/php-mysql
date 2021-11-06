<?php
require_once __DIR__ . '/../../Infrastructure/Dao/CategoryDao.php';
require_once __DIR__ . '/../../Domain/Entity/Category.php';
require_once __DIR__ . '/../Exception/RepositoryException.php';

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
        try {
            $this->categoryDao->update(
                $category->id()->value(),
                $category->name()->value()
            );
        } catch (DaoException $e) {
            throw new RepositoryException('カテゴリーの更新時にエラーが発生しました。', 0, $e);
        }
    }

    public function delete(CategoryId $id): void
    {
        try {
            $this->categoryDao->delete($id->value());
        } catch (DaoException $e) {
            throw new RepositoryException('カテゴリーの削除時にエラーが発生しました。', $e);
        }
    }
}
