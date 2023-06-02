<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compte extends Model
{
    protected $table = 'compte';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function boxes(): BelongsTo
    {
        return $this->belongsTo(Box::class, 'compte_id');
    }
}