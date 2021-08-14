<?php
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$id = filter_input(INPUT_POST, 'id');
$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
$stmt->execute(array(':id' => $id));
header('Location: /index.php');
