<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\TokenInvalid;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/*
 * action pour payer une box
 */
class PostPayAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les données du formulaire
        $post_data = $rq->getParsedBody();

        // vérifier le token csrf
        try {
            CsrfService::check($post_data['csrf']);
        } catch (TokenInvalid $e) {
            throw new HttpBadRequestException($rq, "token invalide");
        }

        // payer la box
        $b = new BoxServices();
        try {
            $b->pay($_GET['id']);
        } catch (\Exception $e) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // redirection vers la page de la box
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('mesBox');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}