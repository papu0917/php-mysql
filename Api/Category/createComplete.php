<?php
require_once(__DIR__ . '/../../Infrastructure/Dao/CategoryDao.php');
require_once __DIR__ . '/../../Domain/Entity/Category.php';
require_once __DIR__ . '/../../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../../UseCase/UseCaseInput/AddCategoryUseCaseInput.php';
require_once __DIR__ . '/../../ViewModel/AddCategoryResponseViewModel.php';
require_once __DIR__ . '/../../UseCase/AddCategoryUseCase.php';

date_default_timezone_set('Asia/Tokyo');
header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
/**
 * POST通信でもグローバル変数「$_POST」からは値を参照できない点に注意してください。
 * その代わり、「php://input」より受け取ったデータを参照することができます。
 */
$name = json_decode(file_get_contents('php://input'), true);

$useCaseInput = new AddCategoryUseCaseInput($name['name']);
$useCase = new AddCategoryUseCase($useCaseInput);
$category = $useCase->handler();
$addCategoryResponseViewModel = new AddCategoryResponseViewModel($category);

echo $addCategoryResponseViewModel->toJson();
die;
