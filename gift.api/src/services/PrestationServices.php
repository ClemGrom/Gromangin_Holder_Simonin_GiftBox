<?php

namespace gift\api\services;

use gift\api\models\Prestation;

class PrestationServices {

    function getPrestations() {
        $prestations = Prestation::all();
        return $prestations->toArray();
    }

    function getPrestationsOfCategorie($id) {
        $prestations = Prestation::where('cat_id', $id)->get();
        return $prestations->toArray();
    }

}