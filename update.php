<?php
require('redirect.php');

$id = $_POST['id'];
$contents = filter_input(INPUT_POST, 'contents');
$deadline = filter_input(INPUT_POST, 'deadline');
$category_id = filter_input(INPUT_POST, 'category');

function formChecker($contents, $deadline)
{
    $form = [];
    if (!$contents) $form[] = "タスクを入力してくださ";
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
    header('Location: /edit.php' . '?id=' . $id);
    // exit();
    die;
}

$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$stmt = $pdo->prepare("update tasks left join categories on tasks.category_id = categories.id set contents = :contents, deadline = :deadline, category_id = :category_id, where tasks.id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
$stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$res = $stmt->execute();

$rdirect = redirect();
die;
