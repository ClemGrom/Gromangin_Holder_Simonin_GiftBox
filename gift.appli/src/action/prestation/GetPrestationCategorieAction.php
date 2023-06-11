<?php

namespace gift\app\action\prestation;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetPrestationCategorieAction
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $id = $args['id'];
        $p = new PrestationsServices();
        $prestations = $p->getPrestationByCategorie($id);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestation.categorie.twig',
            ["prestations" => $prestations]);
    }

}