<?php

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Db\Sql\Sql;
use Laminas\Db\ResultSet\ResultSet;

class LogHandler implements RequestHandlerInterface
{
    private $db;

    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parametri = $request->getQueryParams();

        $dataDa = $parametri['data_da'] ?? null;
        $dataA = $parametri['data_a'] ?? null;
        $maxDate = $parametri['max_date'] ?? null;

        $sql = new Sql($this->db);

        if ($maxDate==null) {
            mb_internal_encoding('UTF-8');
            return new JsonResponse(['errore' => 'Il parametro max_date e obbligatorio.'], 422);
        } else{
            $delete = $sql->delete('log');
            $delete->where->lessThan('DataOra', $maxDate);
            $sql->prepareStatementForSqlObject($delete)->execute();
        }

        $query = $sql->select('log');

        if ($dataDa!=null && $dataA!=null) {
            $query->where->between('DataOra', $dataDa, $dataA);
        }

        $risultati = $this->db->query($sql->buildSqlString($query))->execute();

        $resultSet = new ResultSet();
        $resultSet->initialize($risultati);

        $log = $resultSet->toArray();

        return new JsonResponse($log);
    }
}