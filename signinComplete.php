<?php

session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$pdo = new PDO('mysql:charset=UTF8;dbname=todolist;host=localhost', 'samplephp', 'samplemysql');

$mailChecker = new MailChecker($pdo, $email);
$user = $mailChecker->checker();
// var_dump($user['email']);
// die;
$passwordChecker = new PasswordChecker($user, $password);
$check = $passwordChecker->checker();
echo $check;

class MailChecker
{
    private $pdo;
    private $email;

    public function __construct($pdo, $email)
    {
        $this->pdo = $pdo;
        $this->email = $email;
    }

    public function checker()
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }
}

// if (password_verify($password, $user['password'])) {
//     $_SESSION['id'] = $user['id'];
//     $_SESSION['name'] = $user['name'];
//     $message = 'ログインに成功しました';
//     $link = '<a href="index.php">Topページ</a>';
// } else {
//     $message = 'メールアドレスもしくはパスワードがま間違っています';
//     $link = '<a href="signin.php">戻る</a>';
// }

class PasswordChecker
{
    private $user;
    private $password;

    public function __construct(array $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function checker(): string
    {
        if (password_verify($this->password, $this->user['password'])) {
            $_SESSION['id'] = $this->user['id'];
            $_SESSION['name'] = $this->user['name'];
            $message = 'ログインに成功しました';
            $link = '<a href="index.php">Topページ</a>';
        } else {
            $message = 'メールアドレスもしくはパスワードがま間違っています';
            $link = '<a href="signin.php">戻る</a>';
        }
        return $message . " " . $link;
    }
}

// $task = "select * from tasks where contents = :contents";
