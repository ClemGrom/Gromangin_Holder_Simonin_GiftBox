<?php

namespace gift\app\services\categories;

use gift\app\models\Categorie;
use gift\app\services\prestations\PrestationServiceNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Psr7\Request;

class CategoriesServices
{
    function getCategories(): array
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    function getCategoriesById(Request $rq, int $id): array
    {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $id not found");
        }
    }

    function setNewCategorie(array $categ)
    {
        if ($categ['libelle'] != filter_var($categ['libelle'], FILTER_SANITIZE_STRING)
            || $categ['description'] != filter_var($categ['description'], FILTER_SANITIZE_STRING)) {
            throw new \Exception("Invalide");
        }
        $categorie = new Categorie();
        $categorie->libelle = $categ['libelle'];
        $categorie->description = $categ['description'];
        $categorie->save();
    }

    function createCategories(array $categorie): void
    {
        $categ = new Categorie();
        $categ->libelle = $categorie['libelle'];
        $categ->description = $categorie['description'];
        $categ->save();
    }

    function deleteCategories(int $id): void
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
    }
}