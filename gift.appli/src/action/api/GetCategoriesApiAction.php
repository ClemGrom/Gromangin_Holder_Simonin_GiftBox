<?php

namespace gift\app\action\api;

use gift\app\services\categories\CategoriesServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCategoriesApiAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $p = new CategoriesServices();
        $categories = $p->getCategories();

        $response->getBody()->write($categories);
        return $response->withHeader('Content-Type', 'application/json');

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorie/gift.categorie.twig', [
            'categories' => $categories
        ]);
    }

}
