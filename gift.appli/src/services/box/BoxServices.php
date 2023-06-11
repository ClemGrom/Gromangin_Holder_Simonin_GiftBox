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
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }else {
            throw new \Exception("Vous devez être connecté");
        }
        try{
            $box = Box::where('id', '=', $user['box_id'])->first();
            $presta = Prestation::where('id', '=', $prestaId)->first();
        }catch (BoxServiceException $e){
            throw new HttpBadRequestException("Aucune box en cours de création ou la prestation n'existe pas");
        }
        if($box->statut != Box::CREATED) throw new HttpBadRequestException("La box n'est pas en cours de création");
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
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }else {
            throw new \Exception("Vous devez être connecté");
        }
        try{
            $box = Box::where('id', '=', $user['box_id'])->first();
        }catch (BoxServiceException $e){
            throw new HttpBadRequestException("Aucune box en cours de création ou la prestation n'existe pas");
        }
        return $box->toArray();
    }

    function validate() : void {
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        }else {
            throw new \Exception("Vous devez être connecté");
        }
        $box = Box::where('id', '=', $user['box_id'])->first();
        // récupérer les pivots de la box
        $prestations = $box->prestations()->get();
        $prestations = $prestations->toArray();
        $categorieId = [];
        $valide = true;
        if(count($prestations) < 2) $valide = false;
        foreach ($prestations as $prestation){
            // verifier si les prestations sont dans des catégories différentes
            if(!in_array($prestation['cat_id'], $categorieId)){
                array_push($categorieId, $prestation['cat_id']);
            }
        }
        if(count($categorieId) < 2) $valide = false;
        if($valide) {
            $box->statut = Box::VALIDATED;
            $box->save();
        }else {
            throw new \Exception("La box n'est pas valide");
        }
    }

    function statusBox($boxId) : string {
        $box = Box::where('id', '=', $boxId)->first();
        switch ($box->statut){
            case 1:
                $res = "En cours de création";
                break;
            case 2:
                $res = "Validée";
                break;
            default:
                $res = "Inconnu";
        }
        return $res;
    }

}