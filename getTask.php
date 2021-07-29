<?php

// session_start();
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$userId = $_SESSION['id'];
// var_dump($userId);
// die;
$stmt = $pdo->prepare("select * from tasks where user_id = :user_id");

// (4) 登録するデータをセット
$stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);

// (5) SQL実行
$res = $stmt->execute();
$dataLists = $stmt->fetchAll();
arsort($dataLists);
// var_dump($dataLists['contents']);

// foreach ($user as $u) {
//     echo $u['contents'];
// }

// (7) データベースの接続解除
$pdo = null;
