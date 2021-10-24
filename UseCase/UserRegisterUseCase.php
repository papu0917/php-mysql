<?php
require_once __DIR__ . '/../Interfaces/Repository/UserMySqlRepository.php';
require_once __DIR__ . '/../Domain/ValueObject/UserEmail.php';
require_once __DIR__ . '/../Domain/Factory/NewUserFactory.php';

final class UserRegisterUseCase
{
    private $userMysqlRepository;
    private $input;

    public function __construct(UserResisterUseCaseInput $input)
    {
        $this->userMysqlRepository = new UserMysqlRepository();
        $this->input = $input;
    }

    public function handler(): array
    {
        if ($this->existsSameEmailUser()) {
            $message = '同じメールアドレスが存在します。';
            $link = '<a href="signup.php">戻る</a>';
        } else {
            $this->register();
            $message = '登録できました。';
            $link = '<a href="signin.php">ログインはこちら</a>';
        }

        return [$message, $link];
    }

    private function existsSameEmailUser(): bool
    {
        $email = new UserEmail($this->input->email());
        $user = $this->userMysqlRepository->findByEmail($email);
        return !is_null($user);
    }

    private function register(): void
    {
        $newUser = NewUserFactory::create(
            $this->input->name(),
            $this->input->email(),
            $this->input->password()
        );
        $this->userMysqlRepository->insert($newUser);
    }
}
