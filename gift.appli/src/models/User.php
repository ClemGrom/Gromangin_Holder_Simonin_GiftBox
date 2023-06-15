<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * classe modèle pour les utilisateurs
 */
class User extends Model
{
    // nom de la table
    protected $table = 'user';
    // clé primaire
    protected $primaryKey = 'email';
    public $timestamps = false;
    // clé primaire auto-incrémentée false
    public $incrementing = false;
    // type de la clé primaire
    public $keyType = 'string';
    // champs à remplir
    public $fillable = ['email', 'password'];

    /*
     * relation avec la table box
     */
    public function box(): HasMany
    {
        return $this->hasMany(Box::class, 'user_email');
    }

}