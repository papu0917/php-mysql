<?php

require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Interfaces/Repository/UserMySqlRepository.php';
require_once __DIR__ . '/UseCaseInput/DeleteCategoryUseCaseInput.php';
require_once __DIR__ . '/Exception/UseCaseException.php';
require_once __DIR__ . '/UseCaseInterface/UpdateCategoryUseCaseInterface.php';

final class DeleteCategoryUseCase
{
    private $categoryRepository;
    private $input;

    public function __construct(DeleteCategoryUseCaseInput $input)
    {
        $this->categoryRepository = new CategoryMySqlRepository;
        $this->userRepository = new UserMysqlRepository;
        $this->input = $input;
    }

    /**
     * カテゴリー削除処理の実行
     *
     * @return void
     * @throws UseCaseException
     */
    public function handler(): void
    {
        try {
            $deleteCategory = new CategoryId($this->input->id());
            $this->categoryRepository->delete($deleteCategory);
        } catch (Exception $e) {
            throw new UseCaseException('カテゴリーの削除に失敗しました', 0, $e);
        }
    }
}
