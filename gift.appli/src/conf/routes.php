<?php

use gift\app\action\box\GetDeletePrestaAction;
use gift\app\action\user\GetLogoutAction;
use gift\app\action\box\GetMyBoxAction;
use gift\app\action\box\GetPayAction;
use gift\app\action\box\GetValidateBoxAction;
use gift\app\action\box\PostAddPrestationToBoxAction;
use gift\app\action\box\PostPayAction;
use gift\app\action\user\GetLoginAction;
use gift\app\action\user\PostLoginAction;
use gift\app\action\user\PostRegisterAction;
use gift\app\action\categorie\GetCategoriesAction;
use gift\app\action\categorie\GetCategoriesIDAction;
use gift\app\action\prestation\GetAllPrestationsAction;
use gift\app\action\box\GetNewEmptyBoxAction;
use gift\app\action\prestation\GetPrestationAction;
use gift\app\action\prestation\GetPrestationCategorieAction;
use gift\app\action\box\PostNewEmptyBoxAction;
use gift\app\action\user\GetRegisterAction;

return function (\Slim\App $app): void {

    /*
     * PRESTATIONS
     */
    // Visualiser les prestations
    $app->get('/prestations', GetAllPrestationsAction::class)->setName("prestations");
    // Visualiser une prestation
    $app->get('/prestation', GetPrestationAction::class)->setName("prestation");
    // Visualiser les prestations d'une catégorie
    $app->get('/prestationOfCategorie/{id:\d+}', GetPrestationCategorieAction::class)
        ->setName("categorieToPresta");

    /*
     * CATEGORIES
     */
    // Visualiser les catégories
    $app->get('/categorie[/]', GetCategoriesAction::class)->setName("categorie");
    // Visualiser une catégorie
    $app->get('/categorie/{id:\d}', GetCategoriesIDAction::class)->setName("CategorieID");

    /*
     * BOX
     */
    // Creation Box
    $app->get('/box/new[/]', GetNewEmptyBoxAction::class)->setName("newEmptyBox");
    $app->post('/box/new[/]', PostNewEmptyBoxAction::class);
    // Visualiser Box
    $app->get('/box[/]', GetMyBoxAction::class)->setName("myBox");
    // Valider Box
    $app->get('/box/validate[/]', GetValidateBoxAction::class)->setName("validateBox");
    // Payer Box
    $app->get('/box/pay[/]', GetPayAction::class)->setName("pay");
    $app->post('/box/pay[/]', PostPayAction::class);
    // Supprimer une prestation de la box
    $app->get('/box/delete[/]', GetDeletePrestaAction::class)->setName("deletePresta");
    // Ajouter une prestation à la box
    $app->get('/prestation/add', PostAddPrestationToBoxAction::class)->setName("addPrestationToBox");

    /*
     * USER
     */
    // Inscription
    $app->get('/user/new[/]', GetRegisterAction::class)->setName("newUser");
    $app->post('/user/new[/]', PostRegisterAction::class);
    // Connexion
    $app->get('/user/login[/]', GetLoginAction::class)->setName("login");
    $app->post('/user/login[/]', PostLoginAction::class);
    // Deconnexion
    $app->get('/user/logout[/]', GetLogoutAction::class)->setName("logout");

};