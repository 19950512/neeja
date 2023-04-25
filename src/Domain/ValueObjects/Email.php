<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Exception;

final class Email
{
    public function __construct(
        private string $email
    )
    {
        $this->email = str_replace(' ', '', $this->email);
        $this->email = trim($this->email);

        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("O endereço de email informado {$this->email} não é válido.");
        }

        $this->email = strtolower($this->email);
    }

    function get(): string{
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}