<?php

class SignInViewModel
{
    private $isValid;

    public function __construct(bool $isValid)
    {
        $this->isValid = $isValid;
    }

    public function message(): string
    {
        return $this->isValid ? 'ログインに成功しました' : 'メールアドレスもしくはパスワードが間違っています';
    }

    public function link(): string
    {
        return $this->isValid ? 'index.php' : 'signin.php';
    }

    public function linkText(): string
    {
        return $this->isValid ? 'Topページ' : '戻る';
    }
}
