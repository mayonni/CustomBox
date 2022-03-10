<?php

namespace custumbox\Vue;

use \Slim\Container;
use \custumbox\models\Utilisateur;

  define('SCRIPT_ROOT', 'http://localhost/CrazyCharlyDay/CustomBox/Ressources');

class VuePrincipale{

    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;
    }

    public function afficherProduits():string
    {
        $listeProduits = $this->tab;
        foreach ($listeProduits as $l) {
            $idProduit = $l['id'];
                $content .= "
                <div class='col mb-5'>
                    <div class='card h-100'>
                        <!-- Product image-->
                        <img class='card-img-top' src='$root/Img/produits/$l[id].jpg' alt='...' />
                        <!-- Product details-->
                        <div class='card-body p-4'>
                            <div class='text-center'>
                            <!-- Product name-->
                                <h5 class='fw-bolder'>$l[titre]</h5>
                                <!-- Product weight-->
                                  poids: $l[poids]<br>
                                  catégorie: $l[categorie]<br>
                                  $l[description]

                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                            <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>Ajouter au panier</a></div>
                        </div>
                    </div>
                </div>";
        }

        return $content;
    }

    public function render($selecteur)
    {
         switch ($selecteur) {
              case 1:
              {
                   $content = $this->afficherProduits();
                   if(Authentication::isConnected()){
                    $nom = $_SESSION['user']['name'];
                    $connect =  "nom Compte : $nom";
                } else {
                    $connect = "<button class='btn btn-outline-dark' type='submit'>
                    Connexion / Inscription
                </button>";
                   break;
              };

         }

    $root = SCRIPT_ROOT;


    $html = <<<END
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <meta name='description' content=' />
        <meta name='author' content=' />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
        <!-- Bootstrap icons-->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css' rel='stylesheet' />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href='$root/Css/styles.css' rel='stylesheet' />
    </head>
    <body>
        <!-- Navigation-->
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container px-4 px-lg-5'>
                <a class='navbar-brand' href='#!'>Start Bootstrap</a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                        <li class='nav-item'><a class='nav-link active' aria-current='page' href='#!'>Home</a></li>
                        <li class='nav-item'><a class='nav-link' href='#!'>About</a></li>
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' id='navbarDropdown' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Shop</a>
                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <li><a class='dropdown-item' href='#!'>All Products</a></li>
                                <li><hr class='dropdown-divider' /></li>
                                <li><a class='dropdown-item' href='#!'>Popular Items</a></li>
                                <li><a class='dropdown-item' href='#!'>New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class='d-flex'>
                        <button class='btn btn-outline-dark' type='submit'>
                            <i class='bi-cart-fill me-1'></i>
                            Cart
                            <span class='badge bg-dark text-white ms-1 rounded-pill'>0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class='bg-dark py-5'>
            <div class='container px-4 px-lg-5 my-5'>
                <div class='text-center text-white'>
                    <h1 class='display-4 fw-bolder'>Shop in style</h1>
                    <p class='lead fw-normal text-white-50 mb-0'>With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class='py-5'>
            <div class='container px-4 px-lg-5 mt-5'>
                <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>
                    $content
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class='py-5 bg-dark'>
            <div class='container'><p class='m-0 text-center text-white'>Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
        <!-- Core theme JS-->
        <script src='$root/js/scripts.js'></script>
    </body>
</html>
END;

    return $html;
}

}
}