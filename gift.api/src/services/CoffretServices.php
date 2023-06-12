<?php

namespace gift\api\services;

use gift\api\models\Box;

class CoffretServices {

    function getCoffret($id) {
        $coffret = Box::find($id);
        return $coffret;
    }

    function getPrestationsOfCoffret($id) {
        // récupérer les prestations de la box
        $box = Box::find($id);
        return $box->prestations->toArray();
    }

}