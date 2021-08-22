<?php
session_start();
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);

if ($userId['id'] == $user_id) {
    $categoryDao = new CategoryDao();
    $delete = $categoryDao->delete($id);
    header('Location: /category/index.php');
} else {
    echo "削除できませんでした";
}
