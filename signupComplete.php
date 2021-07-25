<?php

session_start();
date_default_timezone_set('Asia/Tokyo');

// (1) 登録するデータを用意
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');

function formChecker($name, $email, $password, $passwordConfirm)
{
    $messages = [];
    if (!$name) $messages[] = "usernameを入力してください";
    if (!$email) $messages[] = "emilを入力してください";
    if (!$password) $messages[] = "passwordを入力してください";
    if (!$passwordConfirm) $messages[] = "passwordConfirmを入力してください";
    if ($password != $passwordConfirm) $messages[] = "パスワードが一致しません";

    return $messages;
}

$errorMessages = formChecker($name, $email, $password, $passwordConfirm);
if (count($errorMessages) != 0) {
    $_SESSION['errorMessages'] = $errorMessages;
    $_SESSION['formInputs'] = [
        'name' => $name,
        'email' => $email,
    ];
    header('Location: /signup.php');
    die;
}

// (2) データベースに接続
$pdo  = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$user = $stmt->fetch();

if ($user['email'] === $email) {
    $message = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    // (3) SQL作成
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password
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
    $message = '登録できました。';
    $link = '<a href="signin.php">ログインはこちら</a>';
    // (6) データベースの接続解除
    $pdo = null;
}

echo $message;
echo $link;
