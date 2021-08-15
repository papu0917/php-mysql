<?php
session_start();
require_once(__DIR__ . '/./Dao/UserDao.php');
require_once(__DIR__ . '/./Dao/TaskDao.php');

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);

if ($userId['id'] == $user_id) {
    $taskDao = new TaskDao();
    $taskDao->delete($id);

    header('Location: /index.php');
} else {
    echo "削除できませんでした";
}
