<?php

namespace gift\app\action\box;

use gift\app\services\box\BoxServices;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/*
 * action pour payer une box
 */
class GetPayAction
{

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface
    {
        // token csrf
        $token = CsrfService::generate();

        // utilisateur
        $user = $_SESSION['user'];

        // vérifier que la box est valide
        $b = new BoxServices();
        try {
            $b->verificationCoffretValide($_GET['id']);
        } catch (\Exception $e) {
            // erreur : afficher la vue
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'main/gift.error.twig', [
                'error' => $e->getMessage()
            ]);
        }

        // afficher la vue
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'box/gift.pay.twig', [
            'csrf' => $token
        ]);
    }

}