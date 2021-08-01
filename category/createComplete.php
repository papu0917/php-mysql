<?php

// session_start();
require_once(__DIR__ . '/../Dao/CategoryDao.php');
// require_once(dirname(__FILE__) . '/../Dao/CategoryDao.php');
date_default_timezone_set('Asia/Tokyo');
// $userId = $_SESSION['id'];
$name = filter_input(INPUT_POST, 'name');

$categoryDao = new CategoryDao();
$name = $categoryDao->insert($name);

// $stmt = $pdo->prepare("INSERT INTO categories (name) VALUE (:name)");
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $res = $stmt->execute();
$message = '登録できました。';

$pdo = null;

echo $message;
