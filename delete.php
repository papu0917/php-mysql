<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
$stmt->execute(array(':id' => $_GET["id"]));
header('Location: /index.php');
