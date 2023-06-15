<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/*
 * action pour choisir le nombre de prestations
 */
class PostChooseNumberPrestationToBox
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // recuperer le nombre de prestations
        $post_data = $rq->getParsedBody();
        $nbr = $post_data['nbr'];

        $box = new BoxServices();

        // choisir le nombre de prestations
        try {
            $box->chooseNumberPrestationToBox($_GET['id'], $nbr);
        } catch (\Exception $e) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // redirection vers la page de mes box
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}