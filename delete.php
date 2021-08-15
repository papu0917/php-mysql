<?php
session_start();
require_once(__DIR__ . '/./Dao/UserDao.php');

$id = filter_input(INPUT_POST, 'id');
$user_id = $_SESSION['id'];

$userDao = new UserDao();
$userId = $userDao->findById($user_id);

if ($userId['id'] == $user_id) {
    $pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
    $id = filter_input(INPUT_POST, 'id');
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->execute(array(':id' => $id));
    header('Location: /index.php');
} else {
    echo "削除できませんでした";
}
