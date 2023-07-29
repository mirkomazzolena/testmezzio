<?php

namespace App\Handler;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use App\Calcolo\Addizione;
use App\Calcolo\Sottrazione;
use App\Calcolo\Moltiplicazione;
use App\Calcolo\Divisione;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;

class CalcolaHandler implements RequestHandlerInterface
{
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parametri = $request->getQueryParams();

        $calcolo = null;

        switch ($parametri['Operator']) {
            case 'add':
                $calcolo = new Addizione();
                break;
            case 'sub':
                $calcolo = new Sottrazione();
                break;
            case 'mul':
                $calcolo = new Moltiplicazione();
                break;
            case 'div':
                $calcolo = new Divisione();
                break;
            default:
                return new JsonResponse(['errore' => 'Operator deve avere uno dei seguenti valori: add, mul, div o sub'], 422);
        }

        $param1 = floatval($parametri['Param1']);
        $param2 = floatval($parametri['Param2']);
        $param3 = isset($parametri['Param3']) ? floatval($parametri['Param3']) : null;

        $risultato = $calcolo->calcola($param1, $param2, $param3);

        if(is_numeric($risultato)){
            $sql = new Sql($this->db);

            $this->db->query($sql->buildSqlString($sql->insert('log')->values([
                'Param1' => $param1,
                'Param2' => $param2,
                'Param3' => $param3,
                'Operator' => $parametri['Operator'],
                'Risultato' => $risultato,
                'DataOra' => date('Y-m-d H:i:s'),
            ])))->execute();
        }

        return new JsonResponse(['risultato' => $risultato]);
    }
}