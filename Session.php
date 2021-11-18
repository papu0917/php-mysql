<?php

final class Session
{
    const ERROR_KEY = 'errors';

    private static $instance;

    private function __construct()
    {
        // echo "インスタンスを生成しました";
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        self::start();

        return self::$instance;
    }

    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function setAuth(int $id, string $name): void
    {
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
    }

    public function appendError(string $errorMessage): void
    {
        $_SESSION[self::ERROR_KEY][] = $errorMessage;
    }

    public function loadErrorsWithDestory(): array
    {
        $errors = $this->get(self::ERROR_KEY);
        $this->clearErrors();
        return $errors ?? [];
    }

    public function clearErrors(): void
    {
        unset($_SESSION[self::ERROR_KEY]);
    }

    public function clearAuth(): void
    {
        unset($_SESSION['id'], $_SESSION['name']);
    }

    public function setSignInInputErrorMessages(
        SignInInputError $signInInputError,
        string $email
    ): void {

        $_SESSION['errors'] = $signInInputError;
        $_SESSION['formInputs'] = [
            'email' => $email,
        ];
    }
}
