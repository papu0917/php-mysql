<?php
session_start();

require('redirect.php');
require_once(__DIR__ . '/Dao/UserDao.php');
require_once(__DIR__ . '/Dao/TaskDao.php');

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);
$status = 1;

if ($userId['id'] == $user_id) {
    $taskDao = new TaskDao();
    $taskDao->updateStatus($id, $status);
    redirectIndex();
    die;
} else {
    echo "完了できませんでした";
}
