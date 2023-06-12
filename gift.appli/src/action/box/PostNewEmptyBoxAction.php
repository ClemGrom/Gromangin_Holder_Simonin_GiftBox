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

class PostNewEmptyBoxAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $post_data = $rq->getParsedBody();

//        echo $post_data['cadeau'];

        $box = array(
            'libelle' => $post_data['libelle'],
            'description' => $post_data['description'],
            'kdo' => $post_data['cadeau'],
            'message' => $post_data['message'],
            'boxDef' => $post_data['box'],
        );

        try{
            CsrfService::check($post_data['csrf']);
        }catch(TokenInvalid $e) {
            throw new HttpBadRequestException($rq, "token invalide");
        }

        $p = new BoxServices();
        try{
            $p->setNewBox($box);
        }catch(\Exception $e){
            $token = CsrfService::generate();
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'csrf' => $token,
                'error' => $e->getMessage()
            ]);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();
        $url = $routeParser->urlFor('myBox');
        return $rs->withStatus(302)->withHeader('Location', $url);

    }

}