<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}
$stmt = $pdo->prepare("select * from tasks left join categories on category_id = categories.id");

// $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
$res = $stmt->execute();

$dataLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($dataLists);
// die;
arsort($dataLists);
$pdo = null;
