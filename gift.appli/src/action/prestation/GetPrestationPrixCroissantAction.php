<?php

namespace gift\app\action\prestation;

use gift\app\services\prestations\PrestationsServices;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/*
 * action pour afficher les prestations d'une catégorie par prix croissant
 */
class GetPrestationPrixCroissantAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        // trier les prestations par prix croissant
        $p = new PrestationsServices();
        $prestations = $p->getPrestationTriePrixCroissant();

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestations.all.twig',
            ["prestations" => $prestations]);
    }
}