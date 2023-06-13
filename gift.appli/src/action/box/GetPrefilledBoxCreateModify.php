<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPrefilledBoxCreateModify
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token = CsrfService::generate();

        $b = new BoxServices();
        $box = $b->getBox($_GET['id']);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.new.box.prefilled.twig', [
            'csrf' => $token, 'box' => $box
        ]);
    }

}