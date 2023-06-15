<?php

namespace gift\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * model de l'utilisateur
 */
class User extends Model
{
    // nom de la table
    protected $table = 'user';
    // clé primaire
    protected $primaryKey = 'email';
    // pas de timestamp
    public $timestamps = false;
    // pas d'incrémentation automatique
    public $incrementing = false;
    // clé primaire de type string
    public $keyType = 'string';
    // champs remplissables
    public $fillable = ['email', 'password'];

    /*
     * relation avec les boxes
     */
    public function box(): HasMany
    {
        return $this->hasMany(Box::class, 'user_email');
    }

}