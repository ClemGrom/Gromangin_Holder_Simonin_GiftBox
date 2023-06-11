<?php

namespace gift\app\action\user;

use gift\app\services\authentification\AuthServices;
use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class GetLogoutAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $auth = new AuthServices();
        $auth->logout();

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('login');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }

}