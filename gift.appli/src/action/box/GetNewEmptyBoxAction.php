<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action get pour créer une nouvelle box
 */
class GetNewEmptyBoxAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // token csrf
        $token = CsrfService::generate();

        // récupérer les box
        $b = new BoxServices();
        $box = $b->getPrefilledBox();

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.new.box.twig', [
            'csrf' => $token, 'boxes' => $box
        ]);
    }

}