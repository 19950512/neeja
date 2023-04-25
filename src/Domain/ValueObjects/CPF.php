<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Exception;
use App\Shared\Utils;
use App\Domain\ValueObjects\TipoDocumento;

final class CPF implements TipoDocumento
{
    function __construct(
        private string $numero_documento
    ){

        if(!self::validation($this->numero_documento)){
            throw new Exception("O CPF informado {$this->numero_documento}, não está válido.");
        }

        $this->numero_documento = Utils::mask($this->numero_documento, '###.###.###-##');
    }

    public function get(): string {
        return $this->numero_documento;
    }

    static function validation(string $numero_documento): bool
    {

        $cpf = $numero_documento;

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
                 $cpf == '11111111111' ||
                 $cpf == '22222222222' ||
                 $cpf == '33333333333' ||
                 $cpf == '44444444444' ||
                 $cpf == '55555555555' ||
                 $cpf == '66666666666' ||
                 $cpf == '77777777777' ||
                 $cpf == '88888888888' ||
                 $cpf == '99999999999') {
            return false;
        }

        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
        else {
            $digito_um = 0;
            $digito_dois = 0;

            // Calcula o primeiro dígito verificador
            for ($i = 0, $peso = 10; $i < 9; $i++, $peso--) {
                $digito_um += $cpf[$i] * $peso;
            }
            $resto = $digito_um % 11;
            $digito_um = ($resto < 2) ? 0 : 11 - $resto;

            // Calcula o segundo dígito verificador
            for ($i = 0, $peso = 11; $i < 10; $i++, $peso--) {
                $digito_dois += $cpf[$i] * $peso;
            }
            $resto = $digito_dois % 11;
            $digito_dois = ($resto < 2) ? 0 : 11 - $resto;

            // Verifica se os dígitos verificadores estão corretos
            if ($cpf[9] != $digito_um || $cpf[10] != $digito_dois) {
                return false;
            }

            return true;
        }
    }

    public function __toString(): string
    {
        return $this->numero_documento;
    }
}