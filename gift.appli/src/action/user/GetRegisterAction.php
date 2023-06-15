<?php

namespace gift\app\action\user;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour afficher le formulaire d'inscription
 */
class GetRegisterAction
{
    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // générer un token
        $token = CsrfService::generate();

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'user/gift.register.twig', [
            'csrf' => $token
        ]);
    }

}