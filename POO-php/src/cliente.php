<?php
declare(strict_types=1);

class Cliente
{
    private string $email;

    public function __construct(public string $nome, string $email)
    {
        $this->setEmail($email);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $novo): void
    {
        if (!filter_var($novo, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }

        $this->email = $novo;
    }
}
