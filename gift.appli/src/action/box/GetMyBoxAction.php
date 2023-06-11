<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetMyBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $b = new BoxServices();
        $box = $b->getMyBox();
        $status = $b->statusBox($box['id']);
        $p = new PrestationsServices();
        $prestations = $p->getPrestationByBox($box['id']);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.mybox.twig', [
            "box" => $box, "prestations" => $prestations, "status" => $status
        ]);
    }

}