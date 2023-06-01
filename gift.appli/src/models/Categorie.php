<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function prestations(): HasMany
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }

}
