<?php
require_once(__DIR__ . '/Session.php');
$session = Session::getInstance();
date_default_timezone_set('Asia/Tokyo');
require_once(__DIR__ . '/Dao/TaskDao.php');
require('redirect.php');

$id = $_POST['id'];

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
    header('Location: /edit.php' . '?id=' . $id);
    die;
}

$taskDao = new TaskDao();
$taskDao->update($id, $contents, $deadline, $category_id);
redirectIndex();
