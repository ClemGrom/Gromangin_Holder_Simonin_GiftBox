<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\models\User;
use gift\app\services\authentification\AuthServices;
use Ramsey\Uuid\Uuid;
use Slim\Exception\HttpBadRequestException;

class BoxServices {

    function getConnection() : array {
        if(!isset($_SESSION['user'])) throw new \Exception("Vous n'êtes pas connecté");
        return $_SESSION['user'];
    }

    function boxUser() {
        $this->getConnection();
        $user = $_SESSION['user'];
        return Box::where('user_email', '=', $user['email'])->get();
    }

    function boxEnCreation() {
        $boxes = $this->boxUser();
        $box = $boxes->where('statut', '=', Box::CREATED)->first();
        if($box == null) throw new \Exception("Vous n'avez pas de box en cours de création");
        return $box;
    }

    function setNewBox(array $donnee) : void
    {

        $box = $this->boxUser();
        foreach ($box as $b) {
            if($b['statut'] == Box::CREATED) throw new \Exception("Vous avez déjà une box en cours de création");
        }

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

        if (!$valide) throw new \Exception("Box invalide");
        $box->statut = Box::CREATED;
        $user = $_SESSION['user'];
        $box->user_email = $user['email'];
        $box->save();
    }

    function addPrestationToBox(String $prestaId) {
        $box = $this->boxEnCreation();
        $user = $_SESSION['user'];

        $presta = Prestation::where('id', '=', $prestaId)->first();
        if($box->statut != Box::CREATED) throw new \Exception("La box n'est plus en cours de création");
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
        $box = $this->boxEnCreation();
        return $box->toArray();
    }

    function getBox($id) : array {
        $box = Box::where('id', '=', $id)->first();
        return $box->toArray();
    }

    function validate() : void {
        $box = $this->boxEnCreation();

        $prestations = $box->prestations()->get();
        $prestations = $prestations->toArray();
        $categorieId = [];
        $valide = true;
        if(count($prestations) < 2) $valide = false;
        foreach ($prestations as $prestation){

            if(!in_array($prestation['cat_id'], $categorieId)){
                array_push($categorieId, $prestation['cat_id']);
            }
        }
        if(count($categorieId) < 2) $valide = false;
        if($valide) {
            $box->statut = Box::VALIDATED;
            $box->save();
        }else {
            throw new \Exception("La box n'est pas valide, il faut au moins 2 prestations de 2 catégories différentes");
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
            case 3:
                $res = "Payée";
                break;
            default:
                $res = "Inconnu";
        }
        return $res;
    }

    function verificationCoffretValide($boxId) : void {
        $box = Box::where('id', '=', $boxId)->first();
        if($box->statut != 2) throw new \Exception("La box n'est pas validée ou est déjà payée");
    }

    function pay($id) : void {
        $user = $_SESSION['user'];
        $box = Box::where('id', '=', $id)->first();
        $box->statut = Box::PAYED;
        $box->save();
    }

    function deletePrestation($prestationId) : void {
        $user = $_SESSION['user'];
        $box = $this->boxEnCreation();
        $prestation = Prestation::where('id', '=', $prestationId)->first();
        $box->montant = $box->montant - $prestation->tarif * $box->prestations()->get()->find($prestation)->pivot->quantite;
        $box->prestations()->detach($prestation);
        $box->save();
    }

    function getPrefilledBox() : array {
        $boxes = Box::where('token', 'like', '%=')->get();
        return $boxes->toArray();
    }

    function createPrefilledBox($id) : array {
        $this->getConnection();
        $user = $_SESSION['user'];
        $box = $this->boxEnCreation();
        if($box != null) throw new \Exception("Vous avez déjà une box en cours de création");
        $box = Box::where('token', '=', $id)->first();
        $box->statut = Box::CREATED;
        $box->save();
        return $box->toArray();
    }

    function getBoxOfUser($email) : array {
        $boxes = Box::where('user_email', '=', $email)->get();
        return $boxes->toArray();
    }

}