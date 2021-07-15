<?php

date_default_timezone_set('Asia/Tokyo');
// (1) 登録するデータを用意
$name = '北野';
$email = 'kitano@gmail.com';
$password = '12345678';

// (2) データベースに接続
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

// (3) SQL作成
$stmt = $pdo->prepare("INSERT INTO users (
	name, email, password
) VALUES (
	:name, :email, :password
)");

// (4) 登録するデータをセット
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

// (5) SQL実行
$res = $stmt->execute();
var_dump($res);
die;


// (6) データベースの接続解除
$pdo = null;
