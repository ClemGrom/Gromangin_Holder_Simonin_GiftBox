<?php

namespace gift\api\services;

use gift\api\models\Categorie;

class CategorieServices {

    function getCategories() {
        $categories = Categorie::all();
        return $categories->toArray();
    }

}