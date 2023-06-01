<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Coffret extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'coffret';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function comptes(): HasMany
    {
        return $this->hasMany(Compte::class, 'compte_id');
    }

    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class, 'presta_id');
    }

    public function boxs(): HasMany
    {
        return $this->hasMany(Box::class, 'box_id');
    }

}
