<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/*
 * action pour supprimer une prestation d'une box
 */
class GetDeletePrestaAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // supprimer la prestation
        $box = new BoxServices();
        $box->deletePrestation($_GET['id']);

        // redirection vers la box en cours
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }

}