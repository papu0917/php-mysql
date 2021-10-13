<?php
require_once(__DIR__ . '/../../Session.php');
$session = Session::getInstance();

date_default_timezone_set('Asia/Tokyo');
require_once(__DIR__ . '/../../Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/../../Domain/ValueObject/TaskId.php';
require_once __DIR__ . '/../../Interfaces/Repository/TaskMySqlRepository.php';
require_once __DIR__ . '/../../Interfaces/Repository/CategoryMySqlRepository.php';

header("Content-Type: application/json; charset=UTF-8"); //ヘッダー情報の明記。必須。
$newContents = json_decode(file_get_contents('php://input'), true);
// var_dump($newContents);
// die;

$userId = $_SESSION['id'];
// $contents = filter_input(INPUT_POST, 'contents');
// $deadline = filter_input(INPUT_POST, 'deadline');
// $category_id = filter_input(INPUT_POST, 'category');

// function formChecker($contents, $deadline)
// {
//     $form = [];
//     if (!$contents) $form[] = "タスクを入力してください";
//     if (!$deadline) $form[] = "日付を入力してください";
//     return $form;
// }

// $errorMessages = formChecker($contents, $deadline);
// if (count($errorMessages) != 0) {
//     $_SESSION['errorMessages'] = $errorMessages;
//     $_SESSION['formInputs'] = [
//         'contents' => $contents,
//         'deadline' => $deadline,
//     ];
//     header('Location: /create.php');
//     die;
// }

$categoryRepositroy = new CategoryMySqlRepository();
$category = $categoryRepositroy->findById(new CategoryId($newContents['categoryId']));

$newTask = new Task(
    null,
    new UserId($userId),
    new TaskContents($newContents['contents']),
    new DateTime($newContents['deadline']),
    $category
);

$taskRepositroy = new TaskMySqlRepository();
$taskRepositroy->insert($newTask);


$response = [
    'status' => true,
    'messages' => "登録できました",
    'contents' => $newContents['contents'],
    'deadline' => $newContents['deadline'],
    'category' => $category,
];
echo json_encode($response);
die;

header('Location: /index.php');
die;
