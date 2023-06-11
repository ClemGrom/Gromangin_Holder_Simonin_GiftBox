<?php

namespace gift\app\services\prestations;

use gift\app\models\Box;
use gift\app\models\Prestation;

class PrestationsServices
{

    function getPrestationById(string $id): array
    {
        try {
            $prestation = Prestation::findOrFail($id);
        } catch (\Exception $e) {
            throw new PrestationServiceNotFoundException("Prestation non trouvée");
        }
        return $prestation->toArray();
    }

    function getAllPrestationsById(): array
    {
        $prestations = Prestation::all();
        return $prestations->toArray();
    }

    function getPrestationByCategorie(int $categ_id): array
    {
        $prestations = Prestation::where('cat_id', '=', $categ_id)->get();
        return $prestations->toArray();
    }

    function getPrestationByBox(string $box_id): array
    {
        $box = Box::find($box_id);
        $prestations = $box->prestations()->get();
        return $prestations->toArray();
    }


}