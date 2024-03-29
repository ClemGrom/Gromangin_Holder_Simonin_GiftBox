<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use Ramsey\Uuid\Uuid;

/*
 * classe de services pour les box
 */
class BoxServices
{

    /*
     * retourne la connexion de l'utilisateur
     */
    function getConnection(): array
    {
        if (!isset($_SESSION['user'])) throw new \Exception("Vous n'êtes pas connecté");
        return $_SESSION['user'];
    }

    /*
     * retourne les box de l'utilisateur
     */
    function boxUser()
    {
        $this->getConnection();
        $user = $_SESSION['user'];
        return Box::where('user_email', '=', $user['email'])->get();
    }

    /*
     * retourne la box en cours de création
     */
    function boxEnCreation()
    {
        $boxes = $this->boxUser();
        $box = $boxes->where('statut', '=', Box::CREATED)->first();
        if ($box == null) throw new \Exception("Vous n'avez pas de box en cours de création");
        return $box;
    }

    /*
     * créer une nouvelle box
     */
    function setNewBox(array $donnee): void
    {
        $box = $this->boxUser();
        foreach ($box as $b) {
            if ($b['statut'] == Box::CREATED) throw new \Exception("Vous avez déjà une box en cours de création");
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

        if ($donnee['boxDef'] != "vide") {
            $boxDef = Box::where('id', '=', $donnee['boxDef'])->first();
            $prestations = $boxDef->prestations()->get();
            foreach ($prestations as $prestation) {
                $box->prestations()->attach($prestation, ["quantite" => $boxDef->prestations()->get()->find($prestation)->pivot->quantite]);
            }
        }

        if (!$valide) throw new \Exception("Box invalide");
        $box->statut = Box::CREATED;
        $user = $_SESSION['user'];
        $box->user_email = $user['email'];
        $box->save();
    }

    /*
     * ajoute une prestation à la box en cours de création
     */
    function addPrestationToBox(string $prestaId)
    {
        $box = $this->boxEnCreation();
        $user = $_SESSION['user'];

        $presta = Prestation::where('id', '=', $prestaId)->first();
        if ($box->statut != Box::CREATED) throw new \Exception("La box n'est plus en cours de création");
        if ($box->prestations()->get()->contains($presta)) {
            $qte = $box->prestations()->get()->find($presta)->pivot->quantite;
            $box->prestations()->updateExistingPivot($presta, ["quantite" => $qte + 1]);
        } else {
            $box->prestations()->attach($presta, ["quantite" => 1]);
        }
        $box->montant = $box->montant + $presta->tarif;
        $box->save();
    }

    /*
     * choisir le nombre de prestation à ajouter à la box en cours de création
     */
    function chooseNumberPrestationToBox(string $prestaId, int $qte)
    {
        $box = $this->boxEnCreation();

        $presta = Prestation::where('id', '=', $prestaId)->first();

        if ($box->statut != Box::CREATED) throw new \Exception("La box n'est plus en cours de création");
        if ($box->prestations()->get()->contains($presta)) {
            $box->prestations()->updateExistingPivot($presta, ["quantite" => $qte]);
        } else {
            $box->prestations()->attach($presta, ["quantite" => $qte]);
        }

        // calculer le montant à partir des prestations
        $prestations = $box->prestations()->get();
        // calculer le prix de toutes les prestations
        $montant = 0;
        foreach ($prestations as $prestation) {
            $montant += ($prestation->tarif * $prestation->pivot->quantite);
        }
        $box->montant = $montant;
        $box->save();
    }

    /*
     * get la box en cours de création
     */
    function getMyBox(): array
    {
        $box = $this->boxEnCreation();
        return $box->toArray();
    }

    /*
     * get une box par son id
     */
    function getBox($id): array
    {
        $box = Box::where('id', '=', $id)->first();
        return $box->toArray();
    }

    /*
     * valider la box en cours de création
     */
    function validate(): void
    {
        $box = $this->boxEnCreation();

        $prestations = $box->prestations()->get();
        $prestations = $prestations->toArray();
        $categorieId = [];
        $valide = true;
        if (count($prestations) < 2) $valide = false;
        foreach ($prestations as $prestation) {

            if (!in_array($prestation['cat_id'], $categorieId)) {
                array_push($categorieId, $prestation['cat_id']);
            }
        }
        if (count($categorieId) < 2) $valide = false;
        if ($valide) {
            $box->statut = Box::VALIDATED;
            $box->save();
        } else {
            throw new \Exception("La box n'est pas valide, il faut au moins 2 prestations de 2 catégories différentes");
        }
    }

    /*
     * status d'une box
     */
    function statusBox($boxId): string
    {
        $box = Box::where('id', '=', $boxId)->first();
        switch ($box->statut) {
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

    /*
     * verification que la box est valide
     */
    function verificationCoffretValide($boxId): void
    {
        $box = Box::where('id', '=', $boxId)->first();
        if ($box->statut != 2) throw new \Exception("La box n'est pas validée ou est déjà payée");
    }

    /*
     * payement d'une box
     */
    function pay($id): void
    {
        $box = Box::where('id', '=', $id)->first();
        $box->statut = Box::PAYED;
        $box->save();
    }

    /*
     * utilisation d'une box
     */
    function use($id): void
    {
        $box = Box::where('id', '=', $id)->first();
        $box->statut = Box::USED;
        $box->save();
    }

    /*
     * suppression d'une prestation d'une box
     */
    function deletePrestation($prestationId): void
    {
        $user = $_SESSION['user'];
        $box = $this->boxEnCreation();
        $prestation = Prestation::where('id', '=', $prestationId)->first();
        $box->montant = $box->montant - $prestation->tarif * $box->prestations()->get()->find($prestation)->pivot->quantite;
        $box->prestations()->detach($prestation);
        $box->save();
    }

    /*
     * get les box en prefilled
     */
    function getPrefilledBox(): array
    {
        $boxes = Box::where('token', 'like', '%=')->get();
        return $boxes->toArray();
    }

    /*
     * créer une box depuis une box prefilled
     */
    function createPrefilledBox($id)
    {
        $this->getConnection();
        $boxes = $this->boxUser();
        $boxEnCours = $boxes->where('statut', '=', Box::CREATED)->first();
        if ($boxEnCours != null) throw new \Exception("Vous avez déjà une box en cours de création");

        $box = Box::where('id', '=', $id)->first();
        $newBox = new Box();
        $newBox->id = Uuid::uuid4()->toString();
        $newBox->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $newBox->libelle = $box->libelle;
        $newBox->description = $box->description;
        $newBox->kdo = $box->kdo;
        $newBox->message_kdo = $box->message_kdo;
        $newBox->statut = Box::CREATED;
        $newBox->montant = $box->montant;
        $newBox->user_email = $_SESSION['user']['email'];

        $prestations = $box->prestations()->get();
        foreach ($prestations as $prestation) {
            $newBox->prestations()->attach($prestation, ["quantite" => $box->prestations()->get()->find($prestation)->pivot->quantite]);
        }

        $newBox->save();
    }

    /*
     * get les box d'un user
     */
    function getBoxOfUser(): array
    {
        $user = $this->getConnection();
        $boxes = Box::where('user_email', '=', $user['email'])->get();
        return $boxes->toArray();
    }

    /*
     * créer une box et la remplir depuis une box prefilled
     */
    function createPrefilledModifyBox($boxPrefilled, $myModifyBox)
    {
        $this->getConnection();
        $boxes = $this->boxUser();
        $boxEnCours = $boxes->where('statut', '=', Box::CREATED)->first();
        if ($boxEnCours != null) throw new \Exception("Vous avez déjà une box en cours de création");

        $boxPrefilled = Box::where('id', '=', $boxPrefilled)->first();

        $newBox = new Box();
        $newBox->id = Uuid::uuid4()->toString();
        $newBox->token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $newBox->libelle = $myModifyBox['libelle'] == filter_var($myModifyBox['libelle']) ? $myModifyBox['libelle'] : throw new \Exception("Le libelle n'est pas valide");
        $newBox->description = $myModifyBox['description'] == filter_var($myModifyBox['description']) ? $myModifyBox['description'] : throw new \Exception("La description n'est pas valide");
        $newBox->kdo = $myModifyBox['kdo'] == filter_var($myModifyBox['kdo']) ? ($myModifyBox['kdo'] == "oui") ? 1 : 0 : $valide = false;
        if (isset($myModifyBox['message_kdo'])) {
            $newBox->message_kdo = $myModifyBox['message_kdo'] == filter_var($myModifyBox['message_kdo']) ? $myModifyBox['message_kdo'] : throw new \Exception("Le message n'est pas valide");
        }
        $newBox->statut = Box::CREATED;
        $newBox->montant = $boxPrefilled->montant;
        $newBox->user_email = $_SESSION['user']['email'];

        $prestations = $boxPrefilled->prestations()->get();
        foreach ($prestations as $prestation) {
            $newBox->prestations()->attach($prestation, ["quantite" => $boxPrefilled->prestations()->get()->find($prestation)->pivot->quantite]);
        }

        $newBox->save();
    }

}