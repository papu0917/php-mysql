<?php
session_start();
$errorMessages = $_SESSION['errorMessages'] ?? [];
$formInputs = $_SESSION['formInputs'] ?? [];
unset($_SESSION['errorMessages'], $_SESSION['formInputs']);

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


            <form action="signupComplete.php" method="post">
                <div>
                    <input class="width" type="text" name="name" placeholder="User name" value="<?php echo $formInputs['name'] ?? ''; ?>" />
                </div>
                <div>
                    <input class="width" type="text" name="email" placeholder="Email" value="<?php echo $formInputs['email'] ?? ''; ?>" />
                </div>
                <div>
                    <input class="width" type="password" name="password" placeholder="Password">
                </div>
                <div>
                    <input class="width" type="password" name="passwordConfirm" placeholder="Password 確認">
                </div>
                <div>
                    <input class="input" type="submit" value="アカウント作成" />
                </div>
            </form>
            <a href="/signin.php">ログイン画面へ</a>
        </div>
    </div>
</body>

</html>