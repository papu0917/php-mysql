<?php
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';
require_once __DIR__ . '/../Lib/Redirect.php';
require_once __DIR__ . '/../UseCase/DeleteCategoryUseCase.php';
require_once __DIR__ . '/../UseCase/UseCaseInput/DeleteCategoryUseCaseInput.php';
require_once __DIR__ . '/../UseCase/UseCaseOutput/DeleteCategoryUseCaseOutput.php';
require_once __DIR__ . '/../Session.php';

$session = Session::getInstance();

$id = filter_input(INPUT_POST, 'id');
$userId = $session->get('id');

$useCaseInput = new DeleteCategoryUseCaseInput($id, $userId);
$uesCase = new DeleteCategoryUseCase($useCaseInput);
$useCaseOutput = $uesCase->handler();

if (!$useCaseOutput->isSuccess()) {
    $session->appendError($useCaseOutput->message());
}
Redirect::handler($useCaseOutput->redirectPath());
