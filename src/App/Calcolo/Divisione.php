<?php

namespace App\Calcolo;
use Laminas\Diactoros\Response\JsonResponse;

class Divisione extends Calcolo
{
    public function calcola(float $param1, float $param2, ?float $param3 = null)
    {
        if ($param2==0) {
            return 'Divisione per zero non consentita.';
        }

        if (isset($param3) && $param3==0) {
            return 'Divisione per zero non consentita.';
        }

        return $param1 / $param2 / ($param3 ?? 1);
    }
}
