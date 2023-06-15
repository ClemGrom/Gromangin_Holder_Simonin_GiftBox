<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * classe modèle pour les catégories
 */
class Categorie extends Model
{
    // nom de la table
    protected $table = 'categorie';
    // clé primaire
    protected $primaryKey = 'id';
    // clé primaire auto-incrémentée false
    public $timestamps = false;
    // champs à remplir
    protected $fillable = ['libelle', 'description'];

    /*
     * relation avec la table prestation
     */
    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }

}
