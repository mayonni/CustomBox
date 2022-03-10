<?php

namespace custumbox\controller;

use custumbox\Vue\VueConnexion;
use custumbox\models\Utilisateur;
use custumbox\controller\Authentification;
use \Exception;

class ControleurConnexion {

    /**
     * Permet à un utilisateur de se connecter
     * @param rq objet contenant le mdp et le pseudo
     * @param rs objet de retour contenant la vue 
     * @param args arguments de l'url
     */
    static function seConnecter($rq, $rs, $args) {
        $parsed = $rq->getParsedBody();
        $name = filter_var($parsed['name'], FILTER_SANITIZE_STRING);
        $password = filter_var($parsed['password'], FILTER_SANITIZE_STRING);
        // On vérifie si il n'a pas laissé une case vide
        if ((!$name || !$password) || $name == '' || $password == '') {
            $vueConnexion = new VueConnexion($rq, 1);
        }

        // On vérifie si le mot de passe est assez long
        else if (strlen($password) < 10) {
            $vueConnexion = new VueConnexion($rq, 2);
        }
        // Cas où les 2 étapes sont passées
        else {
            $u = Utilisateur::where('name', $name)->first();
            // On vérifie que l'utilisateur existe
            if (!isset($u)) {
                $vueConnexion = new VueConnexion($rq, 4);
            }
            else {
                // On teste le mot de passe
                try {
                    Authentification::authenticate($u, $password);
                    // Si l'authentification a marché, on redirige l'utilisateur vers l'index
                    $path = $rq->getUri()->getBasePath();
                    $rs = $rs->withRedirect($path);
                    return $rs;
                } catch ( Exception $e) {
                    $vueConnexion = new VueConnexion($rq, 3);
                }
            }
        }
        $rs->getBody()->write($vueConnexion->render());
        return $rs;
    }


    static function seDeconnecter($rq, $rs, $args) {
        // On libère la variable de session
        Authentification::freeProfile();
        
        // On redirige l'utilisateur vers l'index
        $path = $rq->getUri()->getBasePath();
        $rs = $rs->withRedirect($path);
        return $rs;
    }

    /**
     * Permet à un utilisateur de se créer un compte
     * @param rq objet contenant le mdp et le pseudo
     * @param rs objet de retour contenant la vue 
     * @param args arguments de l'url
     */
    static function creerCompte($rq, $rs, $args) {
        $parsed = $rq->getParsedBody();
        $name = filter_var($parsed['name'], FILTER_SANITIZE_STRING);
        $password = filter_var($parsed['password'], FILTER_SANITIZE_STRING);
        $surname = filter_var($parsed['surname'], FILTER_SANITIZE_STRING);
        $mail = filter_var($parsed['mail'], FILTER_SANITIZE_STRING);
        $phone = filter_var($parsed['phone'], FILTER_SANITIZE_STRING);
        // On vérifie si il n'a pas laissé une case vide
        if ((!$name || !$password) || $name == '' || $password == '' || $surname == '' || $mail == '' || $phone == '') {
            $vueConnexion = new VueConnexion($rq, 1);
        }
        // On vérifie si le mot de passe est assez long
        else if (strlen($password) < 10) {
            $vueConnexion = new VueConnexion($rq, 2);
        }
        else {
            $u = Utilisateur::where('name', $name)->first();
            // On vérifie si l'utilisateur existe pour ne pas créer un doublon
            if (isset($u)) {
                $vueConnexion = new VueConnexion($rq, 5);
            }
            else {
                // On sauvegarde l'utilisateur
                Authentification::createUser($name, $password, $surname, $mail, $phone);
                $vueConnexion = new VueConnexion($rq);
            }
        }
        $rs->getBody()->write($vueConnexion->render());
        return $rs;
    }


    /**
     * affiche la page de connexion
     * @param rq objet contenant le mdp et le pseudo
     * @param rs objet de retour contenant la vue 
     * @param args arguments de l'url
     */
    static function afficherConnexion($rq, $rs, $args) {
        $vueConnexion = new VueConnexion($rq);
        $rs->getBody()->write($vueConnexion->render());
        return $rs;
    }

    /**
     * fonction chargée d'orienter la requête vers les bonnes méthodes
     * @param rq objet contenant le mdp et le pseudo
     * @param rs objet de retour contenant la vue 
     * @param args arguments de l'url
     */
    static function orienter($rq, $rs, $args) {
        if (isset($args['type'])) {
            if ($args['type'] == 'connex') return ControleurConnexion::seConnecter($rq, $rs, $args);
            else if ($args['type'] == 'crea') return ControleurConnexion::creerCompte($rq, $rs, $args);
        }
    }

    static function afficherUtilisateur($rq, $rs, $args) {
        $vueUtilisateur = new VueUtilisateur($rq);
        $rs->getBody()->write($vueUtilisateur->render());
        return $rs;
    }
    }

}