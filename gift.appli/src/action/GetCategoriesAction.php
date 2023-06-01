<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetCategoriesAction {

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {

        $p = new PrestationsService();
        $categories = $p->getCategories();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.categorie.twig', [
            'categories' => $categories
        ]);
    }

}