<?php

namespace App\Calcolo;

class Addizione extends Calcolo
{
    public function calcola(float $param1, float $param2, ?float $param3 = 0)
    {
        return $param1 + $param2 + $param3;
    }
}
