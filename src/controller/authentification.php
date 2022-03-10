<?php

namespace custumbox\controller;

use custumbox\models\Utilisateur;
use \Exception;

class Authentification {

    /**
     * méthode qui permet de créer un nouvel utilisateur et le sauvegarde dans la bdd
     * @param pseudo nom de l'utilisateur
     * @param password mot de passe pas encore hashé
     */
    static function createUser($pseudo, $password , $surname, $mail, $phone) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $u = new Utilisateur();
        $u->name = $pseudo;
        $u->password = $hash;
        $u->admin = 0;
        $u->surname = $surname;
        $u->mail = $mail;
        $u->phone = $phone;
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
        $hashp = password_hash($p, PASSWORD_DEFAULT);
        if (password_verify($p, $hash)) {
            Authentification::loadProfile($u);
            return true;
        }
        else {
            throw new Exception('Le mot de passe ne correspond pas.');
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
            'admin' => $u->admin,
            'surname' => $u->surname,
            'mail' => $u->mail,
            'phone' => $u->phone,
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

    static function isAdmin() {
        if (isset($_SESSION['user']['admin'])===1) return true;
        else return false;
    }

}