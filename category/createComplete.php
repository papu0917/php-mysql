<?php

// session_start();
require_once(__DIR__ . '/../Dao/CategoryDao.php');
// require_once(dirname(__FILE__) . '/../Dao/CategoryDao.php');
date_default_timezone_set('Asia/Tokyo');
// $userId = $_SESSION['id'];
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
