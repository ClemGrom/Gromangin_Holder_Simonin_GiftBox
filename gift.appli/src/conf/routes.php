<?php

use gift\app\action\box\GetBoxAction;
use gift\app\action\box\GetDeletePrestaAction;
use gift\app\action\box\GetMyBoxAction;
use gift\app\action\box\GetMyBoxesAction;
use gift\app\action\box\GetNewEmptyBoxAction;
use gift\app\action\box\GetPayAction;
use gift\app\action\box\GetPrefilledBoxAction;
use gift\app\action\box\GetPrefilledBoxCreate;
use gift\app\action\box\GetPrefilledBoxCreateModify;
use gift\app\action\box\GetUseBox;
use gift\app\action\box\GetValidateBoxAction;
use gift\app\action\box\PostAddPrestationToBoxAction;
use gift\app\action\box\PostChooseNumberPrestationToBox;
use gift\app\action\box\PostNewEmptyBoxAction;
use gift\app\action\box\PostPayAction;
use gift\app\action\box\PostPrefilledBoxCreateModify;
use gift\app\action\categorie\GetCategoriesAction;
use gift\app\action\categorie\GetCategoriesIDAction;
use gift\app\action\prestation\GetAllPrestationsAction;
use gift\app\action\prestation\GetPrestationAction;
use gift\app\action\prestation\GetPrestationCategorieAction;
use gift\app\action\prestation\GetPrestationPrixCroissantAction;
use gift\app\action\prestation\GetPrestationPrixDecroissantAction;
use gift\app\action\user\GetLoginAction;
use gift\app\action\user\GetLogoutAction;
use gift\app\action\user\GetRegisterAction;
use gift\app\action\user\PostLoginAction;
use gift\app\action\user\PostRegisterAction;

return function (\Slim\App $app): void {

    /*
     * PRESTATIONS
     */
    // Visualiser les prestations
    $app->get('/prestations', GetAllPrestationsAction::class)->setName("prestations");
    //test
    $app->get('/prestationsTrieCroiss', GetPrestationPrixCroissantAction::class)->setName("prestationsTrieCroiss");

    $app->get('/prestationsTrieDecroiss', GetPrestationPrixDecroissantAction::class)->setName("prestationsTrieDecroiss");
    // Visualiser une prestation
    $app->get('/prestation', GetPrestationAction::class)->setName("prestation");
    // Visualiser les prestations d'une catégorie
    $app->get('/prestationOfCategorie/{id:\d+}', GetPrestationCategorieAction::class)
        ->setName("categorieToPresta");

    /*
     * CATEGORIES
     */
    // Visualiser les catégories
    $app->get('[/]', GetCategoriesAction::class)->setName("categorie");
    // Visualiser une catégorie
    $app->get('/categorie/{id:\d}', GetCategoriesIDAction::class)->setName("CategorieID");

    /*
     * BOX
     */
    // Creation Box
    $app->get('/box/new[/]', GetNewEmptyBoxAction::class)->setName("newEmptyBox");

    $app->post('/box/new[/]', PostNewEmptyBoxAction::class);
    // Visualiser ma Box
    $app->get('/box/my[/]', GetMyBoxAction::class)->setName("myBox");
    // Valider Box
    $app->get('/box/validate[/]', GetValidateBoxAction::class)->setName("validateBox");
    // Payer Box
    $app->get('/box/pay[/]', GetPayAction::class)->setName("pay");
    $app->post('/box/pay[/]', PostPayAction::class);
    // Supprimer une prestation de la box
    $app->get('/box/delete[/]', GetDeletePrestaAction::class)->setName("deletePresta");
    // Ajouter une prestation à la box
    $app->get('/prestation/add', PostAddPrestationToBoxAction::class)->setName("addPrestationToBox");

    $app->post('/prestation/choose', PostChooseNumberPrestationToBox::class)->setName("chooseNumberPrestationToBox");
    // Afficher les box préremplies
    $app->get('/box/prefilled[/]', GetPrefilledBoxAction::class)->setName("premadeBox");
    // Visualiser une box
    $app->get('/box', GetBoxAction::class)->setName("box");
    // Créer un coffret à partir d'une box préremplie
    $app->get('/box/prefilled/create', GetPrefilledBoxCreate::class)->setName("newCoffretPrefilled");
    // Créer un coffret à partir d'une box préremplie à modifier
    $app->get('/box/prefilled/create/modify', GetPrefilledBoxCreateModify::class)->setName("newCoffretPrefilledModify");
    $app->post('/box/prefilled/create/modify', PostPrefilledBoxCreateModify::class);
    // Visualiser mes boxes
    $app->get('/box/myBoxes[/]', GetMyBoxesAction::class)->setName("mesBox");
    //Utilisation de box
    $app->get('/box/used', GetUseBox::class)->setName("usedBox");

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