<?php

namespace App\Helpers;

use Exception;

class ValidateSetterData {
    public function validate_string(string $valeur, int $lengthMax, string $field): void
    {
        if (mb_strlen($valeur) > $lengthMax) {
            throw new Exception('Le champ ' . $field . ' ne peut pas dépasser ' . $lengthMax . ' caractères');
        }
    }

    public function validateInteger(Int|String $integer): void
    {
        if (is_numeric(!$integer)) {
            throw new Exception('Le champ' . $integer . 'n\' pas un nombre');
        }
        
    }
}