<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/*
 * action pour valider une box
 */
class GetValidateBoxAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // valider la box
        $box = new BoxServices();
        try {
            $box->validate();
        } catch (\Exception $e) {
            // erreur
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // redirection vers la page de mes box
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('mesBox');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}