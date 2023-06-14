<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostChooseNumberPrestationToBox
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $post_data = $rq->getParsedBody();
        $nbr = $post_data['nbr'];
        echo $nbr;

        $box = new BoxServices();

        try {
            $box->chooseNumberPrestationToBox($_GET['id'], $nbr);
        } catch (\Exception $e) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}