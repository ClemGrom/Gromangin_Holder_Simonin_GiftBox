<?php

namespace gift\api\services;

use gift\api\models\Categorie;

/*
 * services des categories
 */
class CategorieServices
{

    /*
     * récupération des categories
     */
    function getCategories()
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }

}