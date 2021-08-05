<?php

session_start();
date_default_timezone_set('Asia/Tokyo');
$userId = $_SESSION['id'];
$contents = filter_input(INPUT_POST, 'contents');
$category_id = filter_input(INPUT_POST, 'category');
$deadline = filter_input(INPUT_POST, 'deadline');


$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

$stmt = $pdo->prepare("INSERT INTO tasks (user_id, contents, category_id, deadline) VALUE (:user_id, :contents, :category_id, :deadline)");
$stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
$stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
$stmt->bindValue(':category_id', $category_id, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$res = $stmt->execute();
$message = '登録できました。';

$pdo = null;

echo $message;
