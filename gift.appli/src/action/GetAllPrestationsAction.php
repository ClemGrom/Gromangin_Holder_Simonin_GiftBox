<?php



use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetAllPrestationsAction {

    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
       $p = new PrestationsService();
       $prestations = $p->getAllPrestationsById();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'gift.prestations.all.twig',
            [ "prestations" => $prestations]);
    }

}

