<?php

namespace gift\app\action\categorie;

use gift\app\services\categories\CategoriesServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour afficher les catégories
 */
class GetCategoriesAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les catégories
        $p = new CategoriesServices();
        $categories = $p->getCategories();

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorie/gift.categorie.twig', [
            'categories' => $categories
        ]);
    }

}