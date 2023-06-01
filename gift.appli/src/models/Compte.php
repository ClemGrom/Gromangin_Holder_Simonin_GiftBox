<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compte extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'compte';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function coffret(): BelongsTo
    {
        return $this->belongsTo(Coffret::class, 'id');
    }
}