<?php
ini_set('display_errors', 'off');
session_start();
$errorMessages = $_SESSION['errorMessages'] ?? [];
$formInputs = $_SESSION['formInputs'] ?? [];
unset($_SESSION['errorMessages'], $_SESSION['formInputs']);

$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');
    $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
    if ($name === '') {
        $error['name'] = 'blank';
    }
    if ($email === '') {
        $error['email'] = 'blank';
    } elseif (!preg_match($reg_str, $email)) {
        $error['email'] = 'email';
    }
    if ($password === '') {
        $error['password'] = 'blank';
    }
    if ($passwordConfirm === '') {
        $error['passwordConfirm'] = 'blank';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="color">
    <div id="signup">
        <div class="index">
            <p>会員登録</p>
            <?php if (!empty($errorMessages)) : ?>
                <ul class="error_list">
                    <?php foreach ($errorMessages as $errorMessage) : ?>
                        <li><?php echo $errorMessage; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="post" novalidate>
                <div>
                    <input class="width" type="text" name="name" placeholder="User name" required autofocus value="<?php echo $name ?? ''; ?>" />

                </div>
                <?php if ($error['name'] === 'blank') : ?>
                    <p class="error_message">お名前を入力してください</p>
                <?php endif; ?>
                <div>
                    <input class="width" type="text" name="email" placeholder="Email" value="<?php echo $email ?? ''; ?>" />
                </div>
                <?php if ($error['email'] === 'email') : ?>
                    <p class="error_message">メールアドレスを正しく入力してください</p>
                <?php endif; ?>
                <div>
                    <input class="width" type="password" name="password" placeholder="Password">
                </div>
                <?php if ($error['password'] === 'blank') : ?>
                    <p class="error_message">パスワードを入力してください</p>
                <?php endif; ?>
                <div>
                    <input class="width" type="password" name="passwordConfirm" placeholder="Password 確認">
                </div>
                <?php if ($error['passwordConfirm'] === 'blank') : ?>
                    <p class="error_message">パスワードを入力してください</p>
                <?php endif; ?>
                <div>
                    <input class="input" type="submit" value="アカウント作成" />
                </div>
            </form>
            <a href="/signin.php">ログイン画面へ</a>
        </div>
    </div>
</body>

</html>