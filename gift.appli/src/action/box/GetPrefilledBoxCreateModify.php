<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour créer une nouvelle box à partir d'une box prefilled
 */
class GetPrefilledBoxCreateModify
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // token csrf
        $token = CsrfService::generate();

        // récupérer les box
        $b = new BoxServices();
        $box = $b->getBox($_GET['id']);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.new.box.prefilled.twig', [
            'csrf' => $token, 'box' => $box
        ]);
    }

}