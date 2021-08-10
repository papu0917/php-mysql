<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}
$stmt = $pdo->prepare("select * from tasks left join categories on  tasks.category_id = categories.id where user_id = :user_id");
$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
$res = $stmt->execute();
$dataLists = $stmt->fetchAll(PDO::FETCH_ASSOC);

arsort($dataLists);
$pdo = null;
