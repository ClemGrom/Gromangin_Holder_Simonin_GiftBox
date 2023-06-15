<?php

namespace gift\app\action\prestation;

use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

/*
 * action pour afficher une prestation par son id
 */
class GetPrestationAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer l'id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $p = new PrestationsServices();
            $prestation = $p->getPrestationById($id);
        } else {
            throw new HttpBadRequestException($rq, "Identifiant absent");
        }

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestation.twig', [
            'prestation' => $prestation
        ]);
    }

}

