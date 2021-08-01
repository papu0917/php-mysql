<?php

session_start();
date_default_timezone_set('Asia/Tokyo');
$userId = $_SESSION['id'];
$name = filter_input(INPUT_POST, 'name');

$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

$stmt = $pdo->prepare("INSERT INTO categories (name) VALUE (:name)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$res = $stmt->execute();
$message = '登録できました。';

$pdo = null;

echo $message;
