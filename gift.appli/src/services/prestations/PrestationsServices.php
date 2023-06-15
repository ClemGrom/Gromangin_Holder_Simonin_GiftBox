<?php

namespace gift\app\services\prestations;

use gift\app\models\Box;
use gift\app\models\Prestation;

/*
 * classe service pour les prestations
 */
class PrestationsServices
{
    /*
     * retourne une prestation par son id
     */
    function getPrestationById(string $id): array
    {
        try {
            $prestation = Prestation::findOrFail($id);
        } catch (\Exception $e) {
            throw new PrestationServiceNotFoundException("Prestation non trouvée");
        }
        return $prestation->toArray();
    }

    /*
     * retourne toutes les prestations
     */
    function getAllPrestationsById(): array
    {
        $prestations = Prestation::all();
        return $prestations->toArray();
    }

    /*
     * retourne toutes les prestations d'une catégorie
     */
    function getPrestationByCategorie(int $categ_id): array
    {
        $prestations = Prestation::where('cat_id', '=', $categ_id)->get();
        return $prestations->toArray();
    }

     /*
      * retourne toutes les prestations d'une box
      */
    function getPrestationByBox(string $box_id): array
    {
        $box = Box::find($box_id);
        $prestations = $box->prestations()->get();
        return $prestations->toArray();
    }

    /*
     * retourne toutes les prestations d'une box par prix croissant
     */
    function getPrestationTriePrixCroissant(): array
    {
        $prestations = Prestation::orderBy('tarif')->get();
        return $prestations->toArray();
    }

    /*
     * retourne toutes les prestations d'une box par prix décroissant
     */
    function getPrestationTriePrixDecroissant(): array
    {
        $prestations = Prestation::orderByDesc('tarif')->get();
        return $prestations->toArray();
    }

}