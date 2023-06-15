<?php

namespace gift\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/*
 * model de la prestation
 */
class Prestation extends Model
{
    // nom de la table
    protected $table = 'prestation';
    // clé primaire
    protected $primaryKey = 'id';
    // pas de timestamp
    public $timestamps = false;
    // pas d'incrémentation automatique
    public $incrementing = false;
    // clé primaire de type string
    public $keyType = 'string';
    // champs remplissables
    protected $fillable = ['id', 'libelle', 'description', 'tarif', 'unite', 'cat_id'];

    /*
     * relation avec la categorie
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    /*
     * relation avec les boxes
     */
    public function box(): BelongsToMany
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id')
            ->withPivot('quantite');
    }

}
