<?php

declare(strict_types=1);

namespace App\Shared;

final class Utils {

    static function mask(string $val, string $mask): string
    {

        $val = preg_replace("/[^0-9]/", "", $val);
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }
}