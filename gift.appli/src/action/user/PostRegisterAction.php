<?php

namespace gift\app\action\user;

use gift\app\services\authentification\AuthServices;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\TokenInvalid;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

/*
 * action pour s'inscrire
 */
class PostRegisterAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les données du formulaire
        $post_data = $rq->getParsedBody();

        // vérifier le token
        try {
            CsrfService::check($post_data['csrf']);
        } catch (TokenInvalid $e) {
            throw new HttpBadRequestException($rq, "token invalide");
        }

        // s'inscrire
        $auth = new AuthServices();
        try {
            $auth->register($post_data['email'], $post_data['mdp']);
        } catch (\Exception $e) {
            $token = CsrfService::generate();
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'user/gift.register.twig', [
                'csrf' => $token,
                'error' => $e->getMessage()
            ]);
        }

        // redirection vers la page d'accueil
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('login');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}