<?php
require_once(__DIR__ . '/..//Infrastructure/Dao/CategoryDao.php');
date_default_timezone_set('Asia/Tokyo');

$name = filter_input(INPUT_POST, 'name');
if (!$name) {
    $message = '登録できませんでした';
    echo $message;
    die;
} else {
    $categoryDao = new CategoryDao();
    $categoryName = $categoryDao->insert($name);
    header('Location: /category/index.php');
}
$pdo = null;
