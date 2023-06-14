<?php

namespace gift\app\conf;

use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath("/api");
$app->addErrorMiddleware(true, false, false);

define("gift\api\conf\basePath", $app->getBasePath());

return $app;



