<?php

require('../redirect.php');
$id = $_GET['id'];
$status = 1;
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$stmt = $pdo->prepare("update tasks set status = :status where tasks.id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$res = $stmt->execute();

redirect();
die;