<?php
session_start();
require_once(__DIR__ . '/./Infrastructure/Dao/UserDao.php');
require_once(__DIR__ . '/./Infrastructure/Dao/TaskDao.php');
require_once __DIR__ . '/./Interfaces/Repository/TaskMySqlRepository.php';
require_once __DIR__ . '/./Domain/ValueObject/TaskId.php';

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);

if ($userId['id'] == $user_id) {
    $taskId = new taskId($id);
    $taskRepositroy = new taskMySqlRepository();
    $taskRepositroy->delete($taskId);
    header('Location: /index.php');
} else {
    echo "削除できませんでした";
}
