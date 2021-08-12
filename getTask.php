<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$userId = $_SESSION['id'];
if (!$userId) {
    header('Location: /signin.php');
    die;
}
// $sql = "select * from tasks left join users on tasks.user_id";
// $stmt = $pdo->prepare($sql);
// // $stmt = bindValue(':user_id', $userId);
// $stmt->execute();
// $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($user);
// die;

$stmt = $pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id");
$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
$res = $stmt->execute();
$dataLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($dataLists);
// die;

arsort($dataLists);
$pdo = null;
