<?php

namespace gift\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/*
 * model de la box
 */
class Box extends Model
{
    // nom de la table
    protected $table = 'box';
    // clé primaire
    protected $primaryKey = 'id';
    // clé primaire de type string
    public $timestamps = false;
    // pas d'incrémentation automatique
    public $incrementing = false;
    // clé primaire de type string
    public $keyType = 'string';
    public $fillable = ['id', 'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'statut', 'created_at', 'updated_at'];

    // statuts de la box
    const CREATED = 1;
    const VALIDATED = 2;
    const PAYED = 3;

    /*
     * relation avec les prestations
     */
    public function prestations(): BelongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }

    /*
     * relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_email');
    }


}
