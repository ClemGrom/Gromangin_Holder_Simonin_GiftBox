<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour récupérer une box
 */
class GetBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer la box
        $b = new BoxServices();
        $box = $b->getBox($_GET['id']);

        // récupérer les prestations de la box
        $p = new PrestationsServices();
        $prestations = $p->getPrestationByBox($box['id']);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.box.twig', [
            "box" => $box, "prestations" => $prestations
        ]);
    }

}