<?php

namespace gift\app\conf;

use gift\app\services\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath("/Dev/Gromangin_Holder_Simonin_GiftBox/gift.appli/public");
$app->addErrorMiddleware(true, false, false);

$twig = Twig::create("../src/views",
                                        ['cache' => "../src/views/cache",
                                         'auto_reload' => true]);
$app->add(TwigMiddleware::create($app, $twig));

define("gift\app\conf\basePath", $app->getBasePath());

return $app;



