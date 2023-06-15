<?php

use gift\api\action\GetCategoriesApiAction;
use gift\api\action\GetCoffretApiAction;
use gift\api\action\GetPrestationsApiAction;
use gift\api\action\GetPrestationsOfCategorieApiAction;

return function (\Slim\App $app): void {

    // routes
    $app->get('/prestations', GetPrestationsApiAction::class);
    $app->get('/categories', GetCategoriesApiAction::class);
    $app->get('/categories/{id}/prestations', GetPrestationsOfCategorieApiAction::class);
    $app->get('/coffrets/{id}', GetCoffretApiAction::class);
};

