<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetUseBox
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $bs = new BoxServices();
        $bs->use($_GET['id']);
        $box = $bs->getBox($_GET['id']);
        $ps = new PrestationsServices();
        $prestations = $ps->getPrestationByBox($box['id']);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.used.box.twig', ["box" => $box, "prestations" => $prestations]);

    }
}
