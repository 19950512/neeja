<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

interface TipoDocumento
{
    static function validation(string $numero_documento): bool;
    function get(): string;
}