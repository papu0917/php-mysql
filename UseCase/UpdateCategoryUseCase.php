<?php

require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/UseCaseInput/UpdateCategoryUseCaseInput.php';


final class UpdateCategoryUseCase
{
    private $categoryRepository;
    private $input;

    public function __construct(UpdateCategoryUseCaseInput $input)
    {
        $this->categoryRepository = new CategoryMySqlRepository;
        $this->input = $input;
    }

    public function handler()
    {
        $updateCategory = new Category(
            new CategoryId($this->input->id()),
            new CategoryName($this->input->name())
        );
        $this->categoryRepository->update($updateCategory);
    }
}
