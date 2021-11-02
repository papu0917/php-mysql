<?php
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';
require_once __DIR__ . '/../Lib/Redirect.php';
require_once __DIR__ . '/../UseCase/UpdateCategoryUseCase.php';
require_once __DIR__ . '/../UseCase/UseCaseInput/UpdateCategoryUseCaseInput.php';

$id = $_POST['category_id'];
$name = filter_input(INPUT_POST, 'category_name');
// if (!$name) {
//     $message = '更新に失敗しました。カテゴリーを確認してください';
//     echo $message;
//     die;
// }

$useCaseInput = new UpdateCategoryUseCaseInput($id, $name);
$useCase = new UpdateCategoryUseCase($useCaseInput);
$useCase->handler();

$path = '/category/index.php';
Redirect::handler($path);
