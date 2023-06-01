<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetNewCategorieAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token = CsrfService::generate();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.new.categorie.twig', [
            'csrf' => $token
        ]);
    }

}