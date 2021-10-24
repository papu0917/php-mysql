<?php

require_once __DIR__ . '/../Domain/Entity/Category.php';
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once(__DIR__ . '/../UseCase/UseCaseInput/AddCategoryUseCaseInput.php');
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';

final class AddCategoryUseCase
{
    private $categoryRepository;
    private $input;

    public function __construct(AddCategoryUseCaseInput $input)
    {
        $this->categoryRepository = new CategoryMySqlRepository();
        $this->input = $input;
    }

    public function handler(): Category
    {
        $newCategory = new Category(
            null,
            new CategoryName($this->input->name())
        );

        $categoryId = $this->categoryRepository->insert($newCategory);
        return $this->categoryRepository->findById($categoryId);
    }
}
