<?php

namespace gift\app\action\prestation;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour afficher toutes les prestations
 */
class GetAllPrestationsAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les prestations
        $p = new PrestationsServices();
        $prestations = $p->getAllPrestationsById();

        // récupérer les catégories
        $c = new CategoriesServices();
        $categories = $c->getCategories($prestations);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestations.all.twig',
            ["prestations" => $prestations, "categorie" => $categories]);
    }

}

