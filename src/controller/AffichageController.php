<?php

namespace custumbox\controller;

use \Slim\Container;
use custumbox\Vue\VuePrincipale;
use custumbox\models\produit;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AffichageController{

    private Container $container;

    // Constructeur
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function affichage(Request $rq, Response $rs, $args): Response
    {
        $produits = produit::all();
        $vue = new VuePrincipale($produits->toArray(), $this->container);
        $html = $vue->render(1);
        $rs->getBody()->write($html);
        return $rs;
    }

}