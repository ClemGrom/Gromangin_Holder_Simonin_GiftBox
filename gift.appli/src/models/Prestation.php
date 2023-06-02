<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prestation extends Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = ['id', 'libelle', 'description', 'tarif', 'unite', 'cat_id'];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function box(): BelongsToMany
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id');
    }

    public function coffret(): BelongsToMany
    {
        return $this->belongsToMany(Coffret::class, 'coffret2prestation', 'prestation_id', 'coffret_id');
    }

}
