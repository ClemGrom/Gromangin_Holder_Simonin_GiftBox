<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/*
 * classe modèle pour les box
 */
class Box extends Model
{
    // nom de la table
    protected $table = 'box';
    // clé primaire
    protected $primaryKey = 'id';

    public $timestamps = false;
    // clé primaire auto-incrémentée false
    public $incrementing = false;
    // type de la clé primaire
    public $keyType = 'string';
    // champs à remplir
    public $fillable = ['id', 'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'statut', 'created_at', 'updated_at'];

    // constantes pour le statut
    const CREATED = 1;
    const VALIDATED = 2;
    const PAYED = 3;
    const USED = 4;

    /*
     * relation avec la table box2presta
     */
    public function prestations(): BelongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }

    /*
     * relation avec la table user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_email');
    }

}