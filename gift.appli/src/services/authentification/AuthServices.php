<?php

namespace gift\app\services\authentification;

use gift\app\models\User;

class AuthServices
{

    public function authenticate(string $email, string $passwd2check): void{
        $user = User::where('email', '=', $email)->first();
        if(!$user) throw new \Exception("Compte inexistant");
        if (!password_verify($passwd2check, $user->password))
            throw new \Exception("Mot de passe incorrect");
        $_SESSION['user'] = $user->toArray();
    }

    public static function checkPasswordStrength(string $pass, int $minimumLength): bool {
        if (strlen($pass) < $minimumLength || !preg_match("#[A-Z]#", $pass)){
            echo "false";
            return false;
        }else {
            return true;
        }
    }

    public function register(string $email, string $pass): void
    {
        if(User::where('email', '=', $email)->exists()) throw new \Exception("Compte déjà existant");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new \Exception("Email invalide");
        if($email != filter_var($email, FILTER_SANITIZE_EMAIL)) throw new \Exception("Email invalide");
        if($pass != filter_var($pass)) throw new \Exception("Mot de passe invalide");
        if(!self::checkPasswordStrength($pass, 8)) throw new \Exception("Mot de passe trop faible");
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);
        $user = new User();
        $user->email = $email;
        $user->password = $hash;
        $user->save();
    }

    public function addBox(string $email, string $boxId): void
    {
        $user = User::where('email', '=', $email)->first();
        if(!$user) throw new \Exception("Compte inexistant");
        $user->box_id = $boxId;
        $user->save();

        $_SESSION['user'] = $user->toArray();
    }
}