<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsService;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetPrestationCategorieAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $id = $args['id'];
        $p = new PrestationsService();
        $prestations = $p->getPrestationByCategorie($id);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.prestation.categorie.twig', [
            'categ_id' => $id,
            'prestations' => $prestations
        ]);
    }

}