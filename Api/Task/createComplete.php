<?php
require_once(__DIR__ . '/../../Session.php');
require_once __DIR__ . '/../../ViewModel/AddTaskResponseViewModel.php';
require_once __DIR__ . '/../../UseCase/UseCaseInput/AddTaskUseCaseInput.php';
require_once __DIR__ . '/../../UseCase/AddTaskUseCase.php';

header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
date_default_timezone_set('Asia/Tokyo');

$session = Session::getInstance();
$newContents = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['id'];

$useCaseInput = new AddTaskUseCaseInput(
    $userId,
    $newContents['contents'],
    $newContents['deadline'],
    $newContents['categoryId']
);

$useCase = new AddTaskUseCase($useCaseInput);
$output = $useCase->handler();
$task = $output->task();
$addTaskResponseViewModel = new AddTaskResponseViewModel($task);

echo $addTaskResponseViewModel->toJson();
die;
