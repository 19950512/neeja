<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Exception;
use App\Shared\Utils;

final class CNPJ implements TipoDocumento
{
    public function __construct(
        private string $numero_documento
    ) {
        if (!self::validation($this->numero_documento)) {
            throw new Exception("O CNPJ informado {$this->numero_documento}, não está válido.");
        }

        $this->numero_documento = Utils::mask($this->numero_documento, '##.###.###/####-##');
    }

    public function get(): string
    {
        return $this->numero_documento;
    }

    public static function validation(string $numero_documento): bool
    {

        $cnpj = $numero_documento;

        // Elimina possivel mascara
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        // Verifica se o número de digitos informados é igual a 14
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }


        // Valida o primeiro dígito verificador
        $j = 5;
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += intval($cnpj[$i]) * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        // Valida o segundo dígito verificador
        $j = 6;
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += intval($cnpj[$i]) * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function __toString(): string
    {
        return $this->numero_documento;
    }
}