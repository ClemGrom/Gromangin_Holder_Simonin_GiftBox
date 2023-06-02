<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class GetPrestationAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $p = new PrestationsServices();
            $prestation = $p->getPrestationById($id);
        } else {
            throw new HttpBadRequestException($rq, "Identifiant absent");
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.prestation.twig', [
            'prestation' => $prestation
        ]);
    }

}

