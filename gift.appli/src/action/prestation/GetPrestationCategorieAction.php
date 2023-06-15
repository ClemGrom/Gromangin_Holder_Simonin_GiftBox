<?php

namespace gift\app\action\prestation;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/*
 * action pour afficher les prestations d'une catégorie
 */
class GetPrestationCategorieAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        // récupérer l'id
        $id = $args['id'];
        $p = new PrestationsServices();
        $prestations = $p->getPrestationByCategorie($id);

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestation.categorie.twig',
            ["prestations" => $prestations]);
    }

}