<?php

namespace gift\app\action\categorie;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationServiceNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

/*
 * action pour afficher une catégorie par son id
 */
class GetCategoriesIDAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer l'id'
        $id = $args['id'];
        $p = new CategoriesServices();

        // recupérer la catégorie
        try {
            $categorie = $p->getCategoriesById($id);
        } catch (PrestationServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'categorie/gift.categorie.id.twig', $categorie);
    }

}
