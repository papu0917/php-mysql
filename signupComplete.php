<?php

date_default_timezone_set('Asia/Tokyo');

// (1) 登録するデータを用意
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');

function formChecker($name, $password, $passwordConfirm)
{
    if (!$name) return "usernameを入力してください";
    if (!$password) return "passwordを入力してください";
    if (!$passwordConfirm) return "passwordConfirmを入力してください";
    if ($password != $passwordConfirm) return "パスワードが一致しません";
}
$message = formChecker($name, $password, $passwordConfirm);
echo $message;

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
    $message = '登録できました';
    $link = '<a href="signup.php">戻る</a>';
    // (6) データベースの接続解除
    $pdo = null;
}

echo $message;
echo $link;
