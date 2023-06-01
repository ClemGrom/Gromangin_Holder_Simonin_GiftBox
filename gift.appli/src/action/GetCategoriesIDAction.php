<?php

namespace gift\app\action;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationServiceNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetCategoriesIDAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $id = $args['id'];
        $p = new CategoriesServices();

        try {
            $categorie = $p->getCategoriesById($rq, $id);
        } catch (PrestationServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.categorie.id.twig', $categorie);
    }

}
