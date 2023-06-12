<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\categories\CategoriesServices;
use gift\app\services\utils\CsrfService;
use gift\app\services\utils\TokenInvalid;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostAddPrestationToBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {

        $box = new BoxServices();
        try{
            $box->addPrestationToBox($_GET['id']);
        }catch(\Exception $e){
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('prestations');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}