<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour utiliser une box
 */
class GetUseBox
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer la box et l'utiliser
        $bs = new BoxServices();
        $bs->use($_GET['id']);
        $box = $bs->getBox($_GET['id']);
        $ps = new PrestationsServices();
        $prestations = $ps->getPrestationByBox($box['id']);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.used.box.twig', ["box" => $box, "prestations" => $prestations]);

    }
}
