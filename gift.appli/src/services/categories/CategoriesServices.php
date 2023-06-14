<?php

namespace gift\app\services\categories;

use gift\app\models\Categorie;
use gift\app\services\prestations\PrestationServiceNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesServices
{
    function getCategories(): array
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    function getCategoriesById(int $id): array
    {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationServiceNotFoundException("Categorie $id not found");
        }
    }

}