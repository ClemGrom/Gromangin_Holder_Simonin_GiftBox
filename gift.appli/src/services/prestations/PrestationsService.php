<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use gift\app\services\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;

class PrestationsService {

    function getCategories() : array {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    function getCategoriesById(Request $rq, int $id) : array {
        try {
            return  Categorie::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $id not found");
        }
    }

    function setNewCategorie(array $categ) {
        if($categ['libelle'] != filter_var($categ['libelle'], FILTER_SANITIZE_STRING)
            || $categ['description'] != filter_var($categ['description'], FILTER_SANITIZE_STRING)) {
            throw new \Exception("Invalide");
        }
        $categorie = new Categorie();
        $categorie->libelle = $categ['libelle'];
        $categorie->description = $categ['description'];
        $categorie->save();
    }

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

    function createCategories(array $categorie) : void {
        $categ = new Categorie();
        $categ->libelle = $categorie['libelle'];
        $categ->description = $categorie['description'];
        $categ->save();
    }

    function deleteCategories(int $id) : void {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
    }

}