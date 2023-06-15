<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/*
 * classe modèle pour les prestations
 */
class Prestation extends Model
{
    // nom de la table
    protected $table = 'prestation';
    // clé primaire
    protected $primaryKey = 'id';
    public $timestamps = false;
    // clé primaire auto-incrémentée false
    public $incrementing = false;
    // type de la clé primaire
    public $keyType = 'string';
    // champs à remplir
    protected $fillable = ['id', 'libelle', 'description', 'tarif', 'unite', 'cat_id'];

    /*
     * relation avec la table categorie
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    /*
     * relation avec la table box2presta
     */
    public function box(): BelongsToMany
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id')
            ->withPivot('quantite');
    }

}
