<?php

namespace gift\app\action;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use const gift\app\conf\basePath;

class PostNewCategorieAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args) : ResponseInterface
    {
        $categorie = array(
            'libelle' => $_POST['libelle'],
            'description' => $_POST['description']
        );

        CsrfService::check($_POST['csrf']);

        $p = new PrestationsService();
        $p->setNewCategorie($categorie);

        return $rs->withStatus(302)->withHeader('Location',  basePath . '/categories');
    }

}