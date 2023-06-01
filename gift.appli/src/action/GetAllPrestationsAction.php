<?php


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

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.prestations.all.twig',
            ["prestations" => $prestations]);
    }

}

