<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\prestations\PrestationsServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetMyBoxesAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        $b = new BoxServices();
        try{
            $box = $b->getBoxOfUser();
        }catch(\Exception $e){
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.my.boxes.twig', [
            "boxes" => $box
        ]);
    }

}