<?php

namespace gift\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * model de la categorie
 */
class Categorie extends Model
{
    // nom de la table
    protected $table = 'categorie';
    // clé primaire
    protected $primaryKey = 'id';
    // pas de timestamp
    public $timestamps = false;
    protected $fillable = ['libelle', 'description'];

    /*
     * relation avec les prestations
     */
    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }

}
