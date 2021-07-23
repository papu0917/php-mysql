<?php

session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$pdo = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$user = $stmt->fetch();
// var_dump($user);

if (password_verify($password, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $message = 'ログインに成功しました';
    $link = '<a href="index.php">Topページ</a>';
} else {
    $message = 'メールアドレスもしくはパスワードがま間違っています';
    $link = '<a href="signin.php">戻る</a>';
}

echo $message;
echo $link;
