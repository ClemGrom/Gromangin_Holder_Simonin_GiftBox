<?php

use gift\app\action\GetAllPrestationsAction;
use gift\app\action\GetBoxesAction;
use gift\app\action\GetCategoriesAction;
use gift\app\action\GetCategoriesIDAction;
use gift\app\action\GetNewCategorieAction;
use gift\app\action\GetPrestationAction;
use gift\app\action\GetPrestationCategorieAction;
use gift\app\action\PostNewCategorieAction;

return function(\Slim\App $app):void {

    $app->get('/categories[/]', GetCategoriesAction::class)
        ->setName("categories");
    $app->get('/categories/{id:\d}', GetCategoriesIDAction::class)
        ->setName("CategorieID");

    $app->get('/categories/create[/]', GetNewCategorieAction::class)
        ->setName("newCategorie");
    $app->post('/categories/create[/]', PostNewCategorieAction::class);

    $app->get('/prestation', GetPrestationAction::class)
        ->setName("prestation");
    $app->get('/prestations', GetAllPrestationsAction::class)
        ->setName("prestations");
    $app->get('/prestationOfCategorie/{id:\d+}', GetPrestationCategorieAction::class)
        ->setName("categorieToPresta");

    $app->get('/boxes[/]', GetBoxesAction::class);

};