<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = ['id', 'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'statut', 'created_at', 'updated_at'];

    const CREATED = 1;

    public function prestations(): BelongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')->withPivot(['quantite']);
    }

    public function coffrets(): BelongsTo
    {
        return $this->belongsTo(Coffret::class, 'coffret_id');
    }

}
