<?php

final class Session
{
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

    public function setAuth(int $id, string $name): void
    {
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
    }

    public function appendError(string $errorMessage): void
    {
        $_SESSION['errors'][] = $errorMessage;
    }

    public function clearErrors(): void
    {
        unset($_SESSION['errors']);
    }

    public function clearAuth(): void
    {
        unset($_SESSION['id'], $_SESSION['name']);
    }
}
