<?php

namespace gift\api\action;

use gift\api\services\CategorieServices;
use gift\api\services\PrestationServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPrestationsApiAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $p = new PrestationServices();
        $prestations = $p->getPrestations();

        // remplir un tableau avec les données de la base de données pour faire une api
        $presta_api = [];
        foreach ($prestations as $presta) {
            $presta_api[] = [
                'id' => $presta['id'],
                'libelle' => $presta['libelle'],
                'description' => $presta['description'],
                'unite' => $presta['unite'],
                'tarif' => $presta['tarif'],
                'img' => $presta['img'],
                'cat_id' => $presta['cat_id'],
                'href' => '/prestations/' . $presta['id']
            ];
        }

        $rs->getBody()->write(json_encode($presta_api));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}