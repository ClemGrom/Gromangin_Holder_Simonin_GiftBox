<?php

namespace gift\app\services\authentification;

use gift\app\models\User;

/*
 * classe pour gérer l'authentification
 */
class AuthServices
{

    /*
     * vérifier si l'utilisateur à indiqué les bons identifiants
     */
    public function authenticate(string $email, string $passwd2check): void
    {
        if (isset($_SESSION['user'])) throw new \Exception("Vous êtes déjà connecté");
        $user = User::where('email', '=', $email)->first();
        if (!$user) throw new \Exception("Compte inexistant");
        if (!password_verify($passwd2check, $user->password))
            throw new \Exception("Mot de passe incorrect");
        $_SESSION['user'] = $user->toArray();
    }

    /*
     * vérifier si le mot de passe est assez fort
     */
    public static function checkPasswordStrength(string $pass, int $minimumLength): bool
    {
        if (strlen($pass) < $minimumLength || !preg_match("#[A-Z]#", $pass)) {
            return false;
        } else {
            return true;
        }
    }

    /*
     * deconnecter l'utilisateur
     */
    public function logout(): void
    {
        unset($_SESSION['user']);
    }

    /*
     * enregistrer un nouvel utilisateur
     */
    public function register(string $email, string $pass): void
    {
        if (isset($_SESSION['user'])) throw new \Exception("Vous êtes déjà connecté");
        if (User::where('email', '=', $email)->exists()) throw new \Exception("Compte déjà existant");
        if ($email != filter_var($email, FILTER_SANITIZE_EMAIL)) throw new \Exception("Email invalide");
        if ($pass != filter_var($pass)) throw new \Exception("Mot de passe invalide");
        if (!self::checkPasswordStrength($pass, 8)) throw new \Exception("Mot de passe trop faible");

        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);
        $user = new User();
        $user->email = $email;
        $user->password = $hash;
        $user->save();
    }
}