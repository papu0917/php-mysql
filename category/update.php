<?php
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';
require_once __DIR__ . '/../Lib/Redirect.php';
require_once __DIR__ . '/../UseCase/UpdateCategoryUseCase.php';
require_once __DIR__ . '/../UseCase/UseCaseInput/UpdateCategoryUseCaseInput.php';

$id = filter_input(INPUT_POST, 'category_id');
$name = filter_input(INPUT_POST, 'category_name');

// バリデーション
if (empty($name)) {
	// TODO: セッションにエラーメッセージを持たせてリダイレクトする
	die('カテゴリー名が空です');
}

try {
	$useCaseInput = new UpdateCategoryUseCaseInput($id, $name);
	$useCase = new UpdateCategoryUseCase($useCaseInput);
	$useCase->handler();
	$path = '/category/index.php';
	Redirect::handler($path);
} catch (Exception $e) {
	// TODO: セッションにエラーメッセージを持たせてリダイレクトする
	echo $e->getMessage();
	die;
}
