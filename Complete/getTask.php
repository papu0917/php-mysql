<?php
session_start();
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$id = $_SESSION['id'];
$stmt = $pdo->prepare("select tasks.id, tasks.contents, tasks.deadline, categories.name from tasks left join categories on tasks.category_id = categories.id where user_id = :user_id and status = 1");
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$res = $stmt->execute();
$dataLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
arsort($dataLists);
$pdo = null;
