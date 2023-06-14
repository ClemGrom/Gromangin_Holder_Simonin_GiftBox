<?php

namespace gift\api\action;

use gift\api\services\CoffretServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCoffretApiAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['id'];
        $c = new CoffretServices();
        $box = $c->getCoffret($id);

        if ($box == null) {
            $rs->getBody()->write(json_encode(['message' => 'Coffret non trouvé']));
            return $rs->withHeader('Content-Type', 'application/json')->withStatus(404);
        }

        $box = $box->toArray();

        $prestations = $c->getPrestationsOfCoffret($id);
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

        $coffret_api = [
            'id' => $box['id'],
            'token' => $box['token'],
            'libelle' => $box['libelle'],
            'description' => $box['description'],
            'montant' => $box['montant'],
            'kdo' => $box['kdo'],
            'message_kdo' => $box['message_kdo'],
            'statut' => $box['statut'],
            'user_email' => $box['user_email'],
            'created_at' => $box['created_at'],
            'updated_at' => $box['updated_at'],
            'href' => '/coffrets/' . $box['id'],
            'prestations' => $presta_api
        ];

        $rs->getBody()->write(json_encode($coffret_api));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}