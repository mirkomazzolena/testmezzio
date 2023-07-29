<?php 

namespace App\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ValidazioneMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $parametri = $request->getQueryParams();

        if (!isset($parametri['Param1'])){
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Param1 deve essere presente.'], 422);
        } else if (!is_numeric($parametri['Param1'])) {
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Param1 deve essere un numero.'], 422);
        }

        if (!isset($parametri['Param2'])){
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Param2 deve essere presente.'], 422);
        } else if (!is_numeric($parametri['Param2'])) {
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Param2 deve essere un numero.'], 422);
        }

        if (isset($parametri['Param3']) && !is_numeric($parametri['Param3'])) {
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Param3 deve essere un numero.'], 422);
        }

        $operator = $parametri['Operator'] ?? null;
        if (!in_array($operator, ['add', 'mul', 'div', 'sub'])) {
            return new \Laminas\Diactoros\Response\JsonResponse(['errore' => 'Operator deve avere uno dei seguenti valori: add, mul, div o sub'], 422);
        }

        return $handler->handle($request);
    }
}