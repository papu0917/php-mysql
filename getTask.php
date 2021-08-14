<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}

$stmt = $pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 0");
$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
$res = $stmt->execute();
$incompleteTasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
arsort($incompleteTasks);
$pdo = null;
