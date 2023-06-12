<?php

namespace gift\app\action\prestation;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetPrestationPrixDecroissantAction{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $p = new PrestationsServices();
        $prestations = $p->getPrestationTriePrixDecroissant();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestations.all.twig',
            ["prestations" => $prestations]);
    }
}