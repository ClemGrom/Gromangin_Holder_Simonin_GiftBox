<?php

use gift\app\action\box\GetMyBoxAction;
use gift\app\action\box\GetValidateBoxAction;
use gift\app\action\box\PostAddPrestationToBoxAction;
use gift\app\action\user\GetLoginAction;
use gift\app\action\user\PostLoginAction;
use gift\app\action\user\PostRegisterAction;
use gift\app\action\categorie\GetCategoriesAction;
use gift\app\action\categorie\GetCategoriesIDAction;
use gift\app\action\prestation\GetAllPrestationsAction;
use gift\app\action\GetNewCategorieAction;
use gift\app\action\box\GetNewEmptyBoxAction;
use gift\app\action\prestation\GetPrestationAction;
use gift\app\action\prestation\GetPrestationCategorieAction;
use gift\app\action\PostNewCategorieAction;
use gift\app\action\box\PostNewEmptyBoxAction;
use gift\app\action\user\GetRegisterAction;

return function (\Slim\App $app): void {

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
    $app->get('/prestation/add', PostAddPrestationToBoxAction::class)->setName("addPrestationToBox");

    // BOX
    $app->get('/box/new[/]', GetNewEmptyBoxAction::class)->setName("newEmptyBox");
    $app->post('/box/new[/]', PostNewEmptyBoxAction::class);
    $app->get('/box[/]', GetMyBoxAction::class)->setName("myBox");
    $app->get('/box/validate[/]', GetValidateBoxAction::class)->setName("validateBox");


    // USER
    $app->get('/user/new[/]', GetRegisterAction::class)->setName("newUser");
    $app->post('/user/new[/]', PostRegisterAction::class);

    $app->get('/user/login[/]', GetLoginAction::class)->setName("login");
    $app->post('/user/login[/]', PostLoginAction::class);

};