<?php

// session_start();
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$sql = "SELECT * from categories";
$stmt = $pdo->prepare($sql);
$res = $stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($categories);

$pdo = null;
