<?php

namespace gift\api\action;

use gift\api\services\CategorieServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategoriesApiAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $cat = new CategorieServices();
        $categories = $cat->getCategories();

        $categ_api = [];
        foreach ($categories as $categorie) {
            $categ_api[] = [
                'id' => $categorie['id'],
                'libelle' => $categorie['libelle'],
                'description' => $categorie['description'],
                'href' => '/categories/' . $categorie['id']
            ];
        }

        $rs->getBody()->write(json_encode($categ_api));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}