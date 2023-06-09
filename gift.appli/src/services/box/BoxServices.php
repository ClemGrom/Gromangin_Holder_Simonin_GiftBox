<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use Ramsey\Uuid\Uuid;
use Slim\Exception\HttpBadRequestException;

class BoxServices {
    function setNewBox(array $donnee) : void {
        $valide = true;
        $box = new Box();

        $box->id = Uuid::uuid4()->toString();
        $box->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $box->libelle = ($donnee['libelle'] == filter_var($donnee['libelle'])) ? $donnee['libelle'] : $valide = false;
        $box->description = ($donnee['description'] == filter_var($donnee['description'])) ? $donnee['description'] : $valide = false;
        $box->kdo = ($donnee['kdo'] == filter_var($donnee['kdo'])) ? ($donnee['kdo'] == "oui") ? 1 : 0 : $valide = false;
        if ($donnee['kdo'] == "oui" && isset($donnee['message'])) {
            $box->message_kdo = ($donnee['message'] == filter_var($donnee['message'])) ? $donnee['message'] : $valide = false;
        }

        if (!$valide) throw new \Exception("Invalide");
        $box->statut = Box::CREATED;

        $box->save();
    }

    function addPrestationToBox(String $prestaId) {
        try{
            $box = Box::where('statut', '=', Box::CREATED)->first() ;
            $presta = Prestation::where('id', '=', $prestaId)->first();
        }catch (BoxServiceException $e){
            throw new HttpBadRequestException("Aucune box en cours de création ou la prestation n'existe pas");
        }
        if($box->prestations()->get()->contains($presta)){
            $qte = $box->prestations()->get()->find($presta)->pivot->quantite;
            $box->prestations()->updateExistingPivot($presta, ["quantite" =>  $qte + 1]);
        }else{
            $box->prestations()->attach($presta, ["quantite" => 1]);
        }
    }

}