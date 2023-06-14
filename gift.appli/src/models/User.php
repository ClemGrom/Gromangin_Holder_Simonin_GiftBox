<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = ['email', 'password'];

    public function box(): HasMany
    {
        return $this->hasMany(Box::class, 'user_email');
    }

}