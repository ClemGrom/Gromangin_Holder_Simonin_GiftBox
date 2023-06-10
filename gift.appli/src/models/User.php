<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class, 'box_id');
    }

}