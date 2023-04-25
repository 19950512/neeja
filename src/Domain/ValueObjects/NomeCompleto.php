<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Exception;

final class NomeCompleto {

    function __construct(
        private string $name
    ){

        if(!$this->validation($this->name)){
            throw new Exception("O nome completo {$this->name}, não está válido.");
        }

        $this->name = ucwords(mb_strtolower($this->name));

        $mustache = [
            ' Da' => ' da',
            ' De' => ' de',
            ' Di' => ' di',
            ' Do' => ' do',
            ' Du' => ' du',
            ' Das' => ' das',
            ' Dos' => ' dos',
        ];

        $this->name = str_replace(array_keys($mustache), array_values($mustache), $this->name);
    }

    private function validation(string $name): bool {
        // O maior nome do brasil tem 51 caracteres -- Charlingtonglaevionbeecheknavare dos Anjos Mendonça
        if(strlen($name) > 51){
            return false;
        }
        $contain_words_only = preg_match("/^[A-ZÀ-Ÿ][A-zÀ-ÿ']+\s([A-zÀ-ÿ']\s?)*[A-ZÀ-Ÿ][A-zÀ-ÿ']+$/", trim($name));
        $contain_special_chars = preg_match('/[!@#$%((*))+"\/+_|\-\-,\.,;\/~\]\[\[´=0989123567\'"?\¹²³£¢¬\{\}\\\§]/', $name);
        return $contain_words_only && !$contain_special_chars;
    }

    public function get(){
        return $this->name;
    }

    public function __toString(): string
    {
        return  $this->name;
    }
}
