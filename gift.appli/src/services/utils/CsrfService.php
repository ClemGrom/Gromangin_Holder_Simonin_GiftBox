<?php

namespace gift\app\services\utils;

/*
 * classe service pour le token
 */
class CsrfService
{

    const generation = ['abcdefghijklmnopqrstuvwxyz', '0123456789', '?,.;/:!$%*&#([-_^@)]=}{'];
    const lengthPassword = 15;

    /*
     * génèrer un token
     */
    public static function generate(): string
    {
        $motDePasse = "";
        for ($i = 0; $i < self::lengthPassword; $i++) {
            $type = self::generation[rand(0, 2)];
            $motDePasse .= $type[rand(0, strlen($type) - 1)];
        }
        $_SESSION["token"] = $motDePasse;
        return $motDePasse;
    }

    /*
     * vérifier le token
     */
    public static function check($token): void
    {
        $tokenSessions = $_SESSION["token"];
        unset($_SESSION["token"]);
        if ($tokenSessions != $token) {
            throw new TokenInvalid("The token is invalid");
        }
    }

}