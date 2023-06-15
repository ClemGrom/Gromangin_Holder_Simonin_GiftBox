<?php

namespace gift\app\action\user;

use gift\app\services\authentification\AuthServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/*
 * action pour se déconnecter
 */
class GetLogoutAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // se déconnecter
        $auth = new AuthServices();
        $auth->logout();

        // rediriger vers la page d'accueil
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('login');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }

}