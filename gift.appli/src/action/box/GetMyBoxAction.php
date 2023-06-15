<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour afficher la box en cours
 */
class GetMyBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer la box
        $b = new BoxServices();
        try {
            $box = $b->getMyBox();
        } catch (\Exception $e) {
            // afficher la vue erreur avec le message d'erreur en cas d'erreur
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // récupérer les prestations de la box
        $status = $b->statusBox($box['id']);
        $p = new PrestationsServices();
        $prestations = $p->getPrestationByBox($box['id']);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.mybox.twig', [
            "box" => $box, "prestations" => $prestations, "status" => $status
        ]);
    }

}