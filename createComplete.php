<?php
require_once(__DIR__ . '/Session.php');
$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
require_once(__DIR__ . '/Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/Interfaces/Repository/TaskMySqlRepository.php';


$userId = $_SESSION['id'];
$contents = filter_input(INPUT_POST, 'contents');
$deadline = filter_input(INPUT_POST, 'deadline');
$category_id = filter_input(INPUT_POST, 'category');

function formChecker($contents, $deadline)
{
    $form = [];
    if (!$contents) $form[] = "タスクを入力してください";
    if (!$deadline) $form[] = "日付を入力してください";
    return $form;
}

$errorMessages = formChecker($contents, $deadline);
if (count($errorMessages) != 0) {
    $_SESSION['errorMessages'] = $errorMessages;
    $_SESSION['formInputs'] = [
        'contents' => $contents,
        'deadline' => $deadline,
    ];
    header('Location: /create.php');
    die;
}


$newTask = new Task(
    null,
    new UserId($userId),
    $contents,
    new DateTime($deadline),
    $category_id
);

$taskRepositroy = new TaskMySqlRepository();
$taskRepositroy->insert($newTask);

// $taskDao = new TaskDao();
// $taskDao->insert($id, $contents, $deadline, $category_id);
header('Location: /index.php');
die;
