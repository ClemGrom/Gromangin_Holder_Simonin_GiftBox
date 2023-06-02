<?php

namespace gift\app\services\coffrets;

use gift\app\models\Box;
use gift\app\models\Prestation;

class BoxesServices
{
    function addPrestationToBox(int $idBox, int $idPrestation): void
    {
        $box = Box::findOrFail($idBox);
        $prestation = Prestation::findOrFail($idPrestation);
        $box->prestations()->attach($prestation);
    }
}