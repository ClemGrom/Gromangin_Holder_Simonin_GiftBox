<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coffret extends Model
{
    protected $table = 'coffret';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function comptes(): HasMany
    {
        return $this->hasMany(Compte::class, 'compte_id');
    }

    public function prestations(): belongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'coffret2prestation', 'coffret_id', 'prestation_id');
    }

    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class, 'box_id');
    }

}
