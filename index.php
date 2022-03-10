<?php
declare(strict_types=1);
namespace custumbox;

session_start();
require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use custumbox\controller\ControleurConnexion;
use \Illuminate\Database\Capsule\Manager as DB;
use \Slim\Container;
use \Slim\App;

$configuration = [
    'settings' => [
    'displayErrorDetails' => true,
    'dbconf' => '/conf/db.conf.ini' ]
    ];
    $c = new Container($configuration);
    $app = new App($c);

$db = new DB();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$app->get('/', 'custumbox\controller\AffichageController:affichage')->setName('affAccueil');

$app->get(
    '/connexion',
    function ($rq, $rs, $args) {
        return ControleurConnexion::afficherConnexion($rq, $rs,$args);
    }
);

$app->get(
    '/deco',
    function ($rq, $rs, $args) {
        return ControleurConnexion::seDeconnecter($rq, $rs,$args);
    }
);

$app->run();