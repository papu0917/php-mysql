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
    public function handler(): DeleteCategoryUseCaseOutput
    {
        try {
            // $loginUserId = $this->input->userId();
            // $user = $this->userRepository->findById($loginUserId);

            // if ($loginUserId !== $user->id()->value()) {
            //     die('削除権限がありません。');
            //     $path = '/category/index.php';
            //     Redirect::handler($path);
            // }
            $this->deleteCategory();

            return new DeleteCategoryUseCaseOutput(
                true,
                'カテゴリーを削除しました',
                '/category/index.php'
            );
        } catch (Exception $e) {
            // throw new UseCaseException('カテゴリーの削除に失敗しました', 0, $e);
            return new DeleteCategoryUseCaseOutput(
                false,
                $e->getMessage(),
                '/category/index.php'
            );
        }
    }

    private function deleteCategory(): void
    {
        $deleteCategory = new CategoryId($this->input->categoryId());
        $this->categoryRepository->delete($deleteCategory);
    }
}
