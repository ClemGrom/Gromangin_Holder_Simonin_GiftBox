<?php

namespace gift\app\action;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\TokenInvalid;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use const gift\app\conf\basePath;

class PostNewCategorieAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $post_data = $rq->getParsedBody();

        $categorie = array(
            'libelle' => $post_data['libelle'],
            'description' => $post_data['description']
        );

        try{
            CsrfService::check($post_data['csrf']);
        }catch(TokenInvalid $e) {
            throw new HttpBadRequestException($rq, "token invalide");
        }

        $p = new CategoriesServices();
        $p->setNewCategorie($categorie);

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        return $rs->withStatus(302)->withHeader('Location', $url);
    }

}