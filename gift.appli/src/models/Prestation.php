<?php

namespace gift\app\models;
use \Illuminate\Database as eloq;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prestation extends eloq\Eloquent\Model
{
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function categorie(): eloq\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function box(): BelongsToMany {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id');
    }

}
