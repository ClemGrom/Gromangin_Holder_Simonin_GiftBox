<?php

namespace gift\app\services;

use Illuminate\Database\Capsule\Manager as DB;

/*
 * classe service pour les catégories
 */
class Eloquent
{

    /*
     * initialise eloquent
     */
    public static function init($filename): void
    {

        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();

    }

}