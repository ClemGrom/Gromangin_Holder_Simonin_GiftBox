<?php

namespace gift\api\action;

use gift\api\services\CategorieServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/*
 * action de l'api qui ajoute la liste des catégories sur l'api
 */
class GetCategoriesApiAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupération des catégories
        $cat = new CategorieServices();
        $categories = $cat->getCategories();

        // création du tableau de catégories pour l'api
        $categ_api = [];
        foreach ($categories as $categorie) {
            $categ_api[] = [
                'id' => $categorie['id'],
                'libelle' => $categorie['libelle'],
                'description' => $categorie['description'],
                'href' => '/categories/' . $categorie['id']
            ];
        }

        // envoi de la réponse
        $rs->getBody()->write(json_encode($categ_api));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}