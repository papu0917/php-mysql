<?php

// require_once __DIR__ . '/signup.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="color">
    <div id="signup">
        <div class="index">
            <p>確認画面</p>

            <form action="signupComplete.php" method="post">
                <table style="margin-bottom:20px">
                    <tr>
                        <th>名前</th>
                        <td><?php echo $name ?></td>
                        <input type="hidden" class="width" type="text" name="name" value="<?php echo $name ?>">
                    </tr>
                    <tr>
                        <th>メール</th>
                        <td><?php echo $email ?></td>
                        <input type="hidden" class="width" type="text" name="email" value="<?php echo $email ?>">
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td><?php echo $password ?></td>
                        <input type="hidden" class="width" type="text" name="password" value="<?php echo $password ?>">
                    </tr>
                    <tr>
                        <th>パスワード 確認</th>
                        <td><?php echo $passwordConfirm ?></td>
                        <input type="hidden" class="width" type="text" name="passwordConfirm" value="<?php echo $passwordConfirm ?>">
                    </tr>
                </table>
                <input class="input" type="submit" value="アカウント作成" />

            </form>
            <a href="/signin.php">ログイン画面へ</a>
        </div>
    </div>
</body>

</html>