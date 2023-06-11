<?php

namespace gift\app\action\user;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetRegisterAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token = CsrfService::generate();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'user/gift.register.twig', [
            'csrf' => $token
        ]);
    }

}