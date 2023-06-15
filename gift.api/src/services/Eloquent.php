<?php

namespace gift\api\services;

use Illuminate\Database\Capsule\Manager as DB;

/*
 * classe de configuration de Eloquent
 */
class Eloquent
{

    /*
     * initialisation de Eloquent
     * @param $filename : nom du fichier de configuration
     */
    public static function init($filename): void
    {

        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();

    }

}