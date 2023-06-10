<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\services\authentification\AuthServices;
use Ramsey\Uuid\Uuid;
use Slim\Exception\HttpBadRequestException;

class BoxServices {
    function setNewBox(array $donnee) : void {

        $user = $_SESSION['user'];
        if($user == null) throw new HttpBadRequestException("Vous devez être connecté");
        if($user['box_id'] != null) throw new HttpBadRequestException("Vous avez déjà une box en cours de création");

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

        $auth = new AuthServices();
        $auth->addBox($user['email'], $box->id);

        $box->save();
    }

    function addPrestationToBox(String $prestaId) {
        $user = $_SESSION['user'];
        if($user == null) throw new HttpBadRequestException("Vous devez être connecté");
        try{
            $box = Box::where('id', '=', $user['box_id'])->first();
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
        $box->montant = $box->montant + $presta->tarif;
        $box->save();
    }

    function getMyBox() : array {
        $user = $_SESSION['user'];
        if($user == null) throw new HttpBadRequestException("Vous devez être connecté");
        try{
            $box = Box::where('id', '=', $user['box_id'])->first();
        }catch (BoxServiceException $e){
            throw new HttpBadRequestException("Aucune box en cours de création ou la prestation n'existe pas");
        }
        return $box->toArray();
    }

}