<?php

namespace gift\app\action\prestation;

use gift\app\services\categories\CategoriesServices;
use gift\app\services\prestations\PrestationsServices;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetAllPrestationsAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $p = new PrestationsServices();
        $prestations = $p->getAllPrestationsById();

        $c = new CategoriesServices();
        $categories = $c->getCategories($prestations);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'prestation/gift.prestations.all.twig',
            ["prestations" => $prestations, "categories" => $categories]);
    }

}

