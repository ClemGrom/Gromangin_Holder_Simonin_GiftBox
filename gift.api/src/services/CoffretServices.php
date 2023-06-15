<?php

namespace gift\api\services;

use gift\api\models\Box;

/*
 * services des coffrets
 */
class CoffretServices
{

    /*
     * récupération d'un coffret
     * @param $id : id du coffret
     */
    function getCoffret($id)
    {
        $coffret = Box::find($id);
        return $coffret;
    }

    /*
     * récupération des prestations d'un coffret
     * @param $id : id du coffret
     */
    function getPrestationsOfCoffret($id)
    {
        // récupérer les prestations de la box
        $box = Box::find($id);
        return $box->prestations->toArray();
    }

}