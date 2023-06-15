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
 * action pour créer une nouvelle box à partir d'une box prefilled
 */
class PostPrefilledBoxCreateModify
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // récupérer les données
        $post_data = $rq->getParsedBody();

        // créer un tableau avec les données
        $box = array(
            'libelle' => $post_data['libelle'],
            'description' => $post_data['description'],
            'kdo' => $post_data['cadeau'],
            'message' => $post_data['message']
        );

        // vérifier le token csrf
        try {
            CsrfService::check($post_data['csrf']);
        } catch (TokenInvalid $e) {
            throw new HttpBadRequestException($rq, "token invalide");
        }

        // créer la box
        $p = new BoxServices();
        try {
            $p->createPrefilledModifyBox($post_data['box'], $box);
        } catch (\Exception $e) {
            $token = CsrfService::generate();
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'csrf' => $token,
                'error' => $e->getMessage()
            ]);
        }

        // redirection vers la page de la box
        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}