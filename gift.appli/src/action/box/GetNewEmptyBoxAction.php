<?php

namespace gift\app\action\box;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetNewEmptyBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token = CsrfService::generate();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.new.box.twig', [
            'csrf' => $token
        ]);
    }

}