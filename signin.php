<?php
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/SignInInputError.php');

Session::getInstance();
$signInInputError = $_SESSION['errors'] ?? null;
$errorMessages = $signInInputError
    ? $signInInputError->outputAllMessage()
    : [];
$formInputs = $_SESSION['formInputs'] ?? [];
unset($_SESSION['errors'], $_SESSION['formInputs']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="color">
    <div id="signup">
        <div class="index">
            <p>ログイン</p>
            <?php if (!empty($errorMessages)) : ?>
                <ul class="error_list">
                    <?php foreach ($errorMessages as $errorMessage) : ?>
                        <li><?php echo $errorMessage; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="signinComplete.php" method="post">
                <input class="width" type="text" name="email" placeholder="Email" value="<?php echo $formInputs['email'] ?? ''; ?>" /><br />
                <input class="width" type="password" name="password" placeholder="Password" /><br />
                <input class="input" type="submit" value="ログイン" />
            </form>
            <a href="signup.php">アカウントを作る</a>
        </div>
    </div>
</body>

</html>