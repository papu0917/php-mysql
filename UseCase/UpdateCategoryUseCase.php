<?php

require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/UseCaseInput/UpdateCategoryUseCaseInput.php';
require_once __DIR__ . '/../Exception/UseCaseException.php';
require_once __DIR__ . '/UseCaseInterface/UpdateCategoryUseCaseInterface.php';

final class UpdateCategoryUseCase implements UpdateCategoryUseCaseInterface
{
    private $categoryRepository;
    private $input;

    public function __construct(UpdateCategoryUseCaseInput $input)
    {
        $this->categoryRepository = new CategoryMySqlRepository;
        $this->input = $input;
    }

    /**
     * カテゴリー更新処理の実行
     *
     * @return void
     * @throws UseCaseException
     */
    public function handler(): void
    {
        try {
            $updateCategory = new Category(
                new CategoryId($this->input->id()),
                new CategoryName($this->input->name())
            );
            $this->categoryRepository->update($updateCategory);
        } catch (Exception $e) {
            throw new UseCaseException('カテゴリーの更新に失敗しました', 0, $e);
        }
    }
}
