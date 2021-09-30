<?php

session_start();
require_once(__DIR__ . '/Infrastructure/Dao/UserDao.php');
require_once __DIR__ . '/Domain/ValueObject/UserEmail.php';
require_once __DIR__ . '/Domain/Entity/User.php';
require_once __DIR__ . '/Interfaces/Repository/UserMySqlRepository.php';
date_default_timezone_set('Asia/Tokyo');

// (1) 登録するデータを用意
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');

function formChecker($name, $email, $password, $passwordConfirm)
{
    $messages = [];
    if (!$name) $messages[] = "User nameを入力してください";
    if (!$email) $messages[] = "Emailを入力してください";
    if (!$password) $messages[] = "Passwordを入力してください";
    if (!$passwordConfirm) $messages[] = "Password 確認を入力してください";
    if ($password != $passwordConfirm) $messages[] = "Passwordが一致しません";

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

$userEmail = new UserEmail($email);
$userMysqlRepository = new UserMysqlRepository();
$userEmail = $userMysqlRepository->findByEmail($userEmail);

if ($userEmail['email'] === $email) {
    $message = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $newUser = new User(
        null,
        new UserName($name),
        new UserEmail($email),
        new UserPassword($passwordHash)
    );

    $userRepository = new UserMysqlRepository();
    $userRepository->insert($newUser);
    $message = '登録できました。';
    $link = '<a href="signin.php">ログインはこちら</a>';
}

echo $message;
echo $link;
