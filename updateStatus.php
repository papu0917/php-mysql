<?php
session_start();

require('redirect.php');
require_once(__DIR__ . '/Dao/UserDao.php');

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);
$status = 1;

if ($userId['id'] == $user_id) {
    $pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
    $stmt = $pdo->prepare("update tasks set status = :status where tasks.id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $res = $stmt->execute();

    redirectIndex();
    die;
} else {
    echo "完了できませんでした";
}
