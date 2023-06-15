<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour afficher les box d'un utilisateur
 */
class GetMyBoxesAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les box de l'utilisateur
        $b = new BoxServices();
        try {
            $box = $b->getBoxOfUser();
        } catch (\Exception $e) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.my.boxes.twig', [
            "boxes" => $box
        ]);
    }

}