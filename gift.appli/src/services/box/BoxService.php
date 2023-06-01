<?php

namespace gift\app\services\box;

use gift\app\models\Categorie;
use Ramsey\Uuid\Uuid;

class BoxService {

    function create(array $donnee) : void {
        $box = new Box();
        $box->id = Uuid::uuid4()->toString();
        $box->libelle = $donnee['libelle'];
        $box->description = $donnee['description'];

        $box->save();
    }

}