<?php

namespace gift\app\action;

use gift\app\services\categories\CategoriesServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCategoriesAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $p = new CategoriesServices();
        $categories = $p->getCategories();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.categorie.twig', [
            'categories' => $categories
        ]);
    }

}