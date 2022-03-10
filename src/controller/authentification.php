<?php

namespace custumbox\src\controller;

use custumbox\src\models\Utilisateur;
use custumbox\src\exception\WrongPasswordException;

class Authentication {

    /**
     * méthode qui permet de créer un nouvel utilisateur et le sauvegarde dans la bdd
     * @param pseudo nom de l'utilisateur
     * @param password mot de passe pas encore hashé
     */
    static function createUser($pseudo, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $u = new Utilisateur();
        $u->name = $pseudo;
        $u->password = $hash;
        $u->save();
    }

    /**
     * méthode qui vérifie si le mot de passe est correct
     * @param u utilisateur concerné
     * @param p mot de passe à tester
     * @return true si l'authentification a réussi
     */
    static function authenticate($u, $p) {
        $hash = $u->password;
        if (password_verify($p, $hash)) {
            Authentication::loadProfile($u);
            return true;
        }
        else {
            throw new WrongPasswordException('Le mot de passe ne correspond pas.');
            return false;
        }
    }

    /**
     * méthode qui charge le profil de l'utilisateur dans une variable de session
     * @param u objet user correspondant à l'utilisateur
     */
    static function loadProfile($u) {
        $data = [
            'id' => $u->id,
            'name' => $u->name,
        ];
        $_SESSION['user'] = $data;
    }

    static function freeProfile() {
        unset($_SESSION['user']);
    }

    static function isConnected() {
        if (isset($_SESSION['user'])) return true;
        else return false;
    }

}