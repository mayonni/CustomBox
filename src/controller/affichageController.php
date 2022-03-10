<?php

namespace custumbox\controller;

use \Slim\Container;
use custumbox\Vue\principale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class affichageController{

    private Container $container;

    // Constructeur
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function afficherEvenements(Request $rq, Response $rs, $args): Response
    {
        //$vue blablabla
        $html = $vue->render(1);
        $rs->getBody()->write($html);
        return $rs;
    }
}