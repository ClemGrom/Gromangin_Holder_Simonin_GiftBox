<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPrefilledBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $b = new BoxServices();
        $boxes = $b->getPrefilledBox();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.prefilled.twig', [
            'boxes' => $boxes
        ]);
    }

}