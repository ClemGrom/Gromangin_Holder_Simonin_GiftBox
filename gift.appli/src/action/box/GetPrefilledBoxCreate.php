<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetPrefilledBoxCreate
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $b = new BoxServices();
        $box = $b->createPrefilledBox($_GET['id']);

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }

}