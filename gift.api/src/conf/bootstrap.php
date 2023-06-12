<?php

namespace gift\app\conf;

use gift\app\services\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath("/api");
$app->addErrorMiddleware(true, false, false);

define("gift\api\conf\basePath", $app->getBasePath());

return $app;



