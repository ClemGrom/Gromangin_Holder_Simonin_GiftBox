<?php

namespace gift\api\services;

use gift\api\models\Prestation;

/*
 * services des prestations
 */
class PrestationServices
{

    /*
     * récupération des prestations
     */
    function getPrestations()
    {
        $prestations = Prestation::all();
        return $prestations->toArray();
    }

    /*
     * récupération des prestations d'une catégorie
     */
    function getPrestationsOfCategorie($id)
    {
        $prestations = Prestation::where('cat_id', $id)->get();
        return $prestations->toArray();
    }

}