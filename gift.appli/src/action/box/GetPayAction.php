<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetPayAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $token = CsrfService::generate();

        $user = $_SESSION['user'];

        $b = new BoxServices();
        try{
            $b->verificationCoffretValide($user['box_id']);
        }catch(\Exception $e){
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.pay.twig', [
            'csrf' => $token
        ]);
    }

}