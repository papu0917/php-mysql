<?php
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/SignInValidate.php');
require_once __DIR__ . '/Interfaces/Repository/UserMySqlRepository.php';
require_once(__DIR__ . '/ViewModel/SignInViewModel.php');
require_once __DIR__ . '/Domain/Entity/User.php';
require_once __DIR__ . '/Domain/Entity/User.php';
require_once __DIR__ . '/UseCase/UseCaseInput/UserSignInUseCaseInput.php';
require_once __DIR__ . '/UseCase/UserSignInUseCase.php';
require_once __DIR__ . '/Lib/Redirect.php';

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$signInValidate = new SignInValidate($email, $password);
$signInInputError = $signInValidate->messages();

if (!$signInInputError->isEmpty()) {
    $session = Session::getInstance();
    $session->setSignInInputErrorMessages($signInInputError, $email);

    $path = '/signin.php';
    Redirect::handler($path);
}

$userEmail = new UserEmail($email);
$useCaseInput = new UserSignInUseCaseInput($userEmail, $password);
$useCase = new UserSignInUseCase($useCaseInput);
$useCaseOutput = $useCase->handler();
$signInViewModel = new SignInViewModel($useCaseOutput->isSuccess());
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<div id="wrapper">
    <?php require('header.php'); ?>
    <div class="message">
        <p><?php echo $signInViewModel->message(); ?></p>

        <a href="<?php echo $signInViewModel->link(); ?>">
            <?php echo $signInViewModel->linkText(); ?>
        </a>
    </div>
    <?php require('footer.php'); ?>
</div>

</html>