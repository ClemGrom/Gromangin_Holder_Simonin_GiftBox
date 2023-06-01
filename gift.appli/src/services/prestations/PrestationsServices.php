<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use gift\app\services\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;

class PrestationsServices {



    function getPrestationById(Request $rq, string $id) : array {
        try{
            $prestation = Prestation::findOrFail($id);
        }catch (\Exception $e) {
            throw new HttpNotFoundException($rq, "Prestation non trouvée");
        }
        return $prestation->toArray();
    }

    function getAllPrestationsById() : array {
        $prestations = Prestation::all();
        return $prestations->toArray();
    }

    function getPrestationByCategorie(int $categ_id) : array {
        $prestations = Prestation::where('cat_id', '=', $categ_id)->get();
        return $prestations->toArray();
    }

    function modifyPrestation(array $modif) : void {
        $prestation = Prestation::findOrFail($modif['id']);
        $prestation->libelle = $modif['libelle'];
        $prestation->description = $modif['description'];
        $prestation->tarif = $modif['tarif'];
        $prestation->unite = $modif['unite'];
        $prestation->save();
    }

    function defineOrModifyCategorieOfPrestation(int $prestationID, int $categorieID) : void {
        $prestation = Prestation::findOrFail($prestationID);
        $prestation->categorie()->associate($categorieID);
        $prestation->save();
    }


}