<?php

date_default_timezone_set('Asia/Tokyo');
// (1) 登録するデータを用意
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');

if ($password != $passwordConfirm) {
    echo "パスワードが一致しません";
    die;
}

// (2) データベースに接続
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

// (3) SQL作成
$stmt = $pdo->prepare("INSERT INTO users (
	name, email, password
) VALUES (
	:name, :email, :password
)");

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// (4) 登録するデータをセット
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);

// (5) SQL実行
$res = $stmt->execute();

// (6) データベースの接続解除
$pdo = null;
