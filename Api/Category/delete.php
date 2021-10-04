<?php
session_start();
require_once(__DIR__ . '/../Infrastructure/Dao/CategoryDao.php');
require_once(__DIR__ . '/../Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/../Interfaces/Repository/CategoryMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryId.php';
require_once __DIR__ . '/../Domain/ValueObject/CategoryName.php';

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];
$userDao = new UserDao();
$userId = $userDao->findById($user_id);

if ($userId['id'] == $user_id) {
    $categoryId = new CategoryId($id);
    $categoryRepositroy = new CategoryMySqlRepository();
    $categoryRepositroy->delete($categoryId);
    header('Location: /category/index.php');
} else {
    echo "削除できませんでした";
}
