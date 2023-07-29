<?php

namespace App\Calcolo;

class Moltiplicazione extends Calcolo
{
    public function calcola(float $param1, float $param2, ?float $param3 = null)
    {
        return $param1 * $param2 * ($param3 ?? 1);
    }
}
