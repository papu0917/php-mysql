<?php
require_once(__DIR__ . '/Session.php');
require_once(__DIR__ . '/SignInInputError.php');

final class SignInValidate
{
    private $email;
    private $passWord;

    public function __construct(string $email, string $passWord)
    {
        $this->email = $email;
        $this->passWord = $passWord;
    }

    public function messages(): SignInInputError
    {
        $emailErrorMessage = empty($this->email)
            ? "Emailを入力してください"
            : null;
        $passwordErrorMessage = empty($this->passWord)
            ? "Passwordを入力してください"
            : null;

        return new SignInInputError($emailErrorMessage, $passwordErrorMessage);
    }
}
