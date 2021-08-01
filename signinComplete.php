<?php
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/Dao/UserDao.php');
require_once(__DIR__ . '/ViewModel/SignInViewModel.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$userDao = new UserDao();
$user = $userDao->findByEmail($email);

$isValid = password_verify($password, $user['password']);
$signInViewModel = new SignInViewModel($isValid);

if ($isValid) {
    $session = Session::getInstance();
    $session->setAuth($user['id'], $user['name']);
}

?>
<p><?php echo $signInViewModel->message(); ?></p>

<a href="<?php echo $signInViewModel->link(); ?>">
    <?php echo $signInViewModel->linkText(); ?>
</a>