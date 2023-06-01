<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Categorie;
use Ramsey\Uuid\Uuid;

class BoxService {

    function create(array $donnee) : void {
        $valide = true;
        $box = new Box();

        $box->id = Uuid::uuid4()->toString();
        $box->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $box->libelle = ($donnee['libelle'] == filter_var($donnee['libelle'])) ? $donnee['libelle'] : $valide = false;
        $box->description = ($donnee['description'] == filter_var($donnee['description'])) ? $donnee['description'] : $valide = false;
        $box->kdo = ($donnee['kdo'] == filter_var($donnee['kdo'])) ? $donnee['kdo'] : $valide = false;
        if(isset($donnee['message_kdo'])) {
            $box->message_kdo = ($donnee['message_kdo'] == filter_var($donnee['message_kdo'])) ? $donnee['message_kdo'] : $valide = false;
        }

        if(!$valide) throw new \Exception("Invalide");
        $box->status = Box::CREATED;

        $box->save();
    }

}