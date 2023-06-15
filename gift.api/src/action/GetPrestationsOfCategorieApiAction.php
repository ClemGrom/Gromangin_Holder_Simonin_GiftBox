<?php

namespace gift\api\action;

use gift\api\services\PrestationServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/*
 * action de l'api qui ajoute la liste des prestations d'une categorie sur l'api
 */
class GetPrestationsOfCategorieApiAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupération des prestations
        $id = $args['id'];
        $p = new PrestationServices();
        $prestations = $p->getPrestationsOfCategorie($id);

        // création du tableau de prestations pour l'api
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

        // envoi de la réponse
        $rs->getBody()->write(json_encode($presta_api));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}