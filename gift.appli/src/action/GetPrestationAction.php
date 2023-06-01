<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetPrestationAction {

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $p = new PrestationsService();
            $prestation = $p->getPrestationById($rq, $id);
        }else{
            throw new HttpBadRequestException($rq, "Identifiant absent");
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.prestation.twig', [
            'prestation' => $prestation
        ]);
    }

}

