<?php

namespace custumbox\Vue;


use custumbox\controller\Authentification;
use \Slim\Container;

  define('SCRIPT_ROOT', 'http://localhost/CrazyCharlyDay/CustomBox/Ressources');
class VuePrincipale{


    public array $tab;
    public Container $container;
    public string  $fdg;

    public function __construct(array $tab, Container $container)
    {
        $this->tab = $tab;
        $this->container = $container;

    }

    public function afficherProduits($rq):string
    {
        $path = $rq->getUri()->getBasePath();
        echo($path."/Ressources/Img/produits/.jpg");
        $listeProduits = $this->tab;
        foreach ($listeProduits as $l) {
            $idProduit = $l['id'];
                $content .= "
                <div class='col mb-5'>
                    <div class='card h-100'>
                        <!-- Product image-->
                        <img class='card-img-top' src=$path/Ressources/Img/produits/$idProduit.jpg alt='...' />
                        <!-- Product details-->
                        <div class='card-body p-4'>
                            <div class='text-center'>
                            <!-- Product name-->
                                <h5 class='fw-bolder text-dark titre'>$l[titre]</h5>
                                <!-- Product weight-->
                                  <p>poids:<span class='text-dark poids'> $l[poids]</span></p>
                                  <p class='text-dark categorie'>Atelier: $l[categorie]</p>
                                  <p class='text-dark'>$l[description]</p>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                            <div class='text-center'><a class='btn btn-outline-dark mt-auto' id=$l[titre]>Ajouter à ma box</a></div>
                        </div>
                    </div>
                </div>";
        }

        return $content;
    }

    public function render($selecteur,$rq)
    {

         switch ($selecteur) {
              case 1:
              {
                   $content = $this->afficherProduits($rq);
                  $path = $rq->getUri()->getBasePath();
                  if(Authentification::isConnected()){
                      $nom = $_SESSION['user']['name'];
                      $connect =  <<<END
                      <a class="nav-link" href="$path/user">$nom</a> <a class="nav-link" href="$path/deco">Deconnexion</a>
 END;
                    if(Authentification::isAdmin()){
                        $vueAdmin = <<<END
<p> vue admin </p>
END;
                    } else {
                        $vueAdmin = "";
                    }
                  } else {
                      $connect = <<<END
 <a class='btn btn-outline-dark' href="$path/connexion"> Connexion / Inscription </a>
 END;
 $vueAdmin = "";
                  }
                   break;
              }

         }

    $root = SCRIPT_ROOT;

    $html = <<<END
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <meta name='description' content='' />
        <meta name='author' content='' />
        <title>CustomBox</title>
        <!-- Favicon-->
        <link rel='icon' type='image/x-icon' href='assets/favicon.ico' />
        <!-- Bootstrap icons-->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css' rel='stylesheet' />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href='$root/Css/styles.css' rel='stylesheet' />
     </head>
        <body>
            <!-- Navigation-->
            <nav class='navbar navbar-expand-lg navbar-light bg-light fixed-top'>
                <div class='container px-4 px-lg-5'>
                    <a class='navbar-brand'>L'Atelier</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                        <li class='nav-item'><a class='nav-link active' href='#accueil'>Accueil</a></li>
                        <li class='nav-item'><a class='nav-link active' href='#atelier'>Ateliers</a></li>
                         <li class='nav-item'><a class='nav-link active' href='#custom'>CustomBox</a></li>
                        <li class='nav-item'><a class='nav-link active' href='#prods'>Produits</a></li>
                        </ul>
                        <form class='d-flex'>
                            <div>
                            $connect
                            &emsp;
                            <button id='cart' class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i  class="bi-cart-fill me-1"></i>
                                Ma box
                                <span id='nombre-produit' class="badge bg-dark text-white ms-1 rounded-pill"></span>
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                          <div class='offcanvas-header'>
                                            <h5 id="offcanvasRightLabel">Contenu de votre box</h5>
                                            <button type="button" class='btn-close text-reset' data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                          </div>
                                          <div style='position:relative;'>
                                          <div class='offcanvas-body' id='contenu-panier'>


                                          </div>
                                          <div style='position:absolute; bottom:0;'>
                                          &emsp;

                                          </div>
                                          </div>
                                        </div>

        <!-- Icon -->
        <section class='bg-dark py-5' id='accueil'>
                    <div class='container px-4 px-lg-5 my-5'>
                        <div class='text-center text-white'>
                            <img class='rounded' src='$root/Img/logos/logocolor.png' width='300' height='300'>
                            <h1 class='display-4 fw-bolder'>L'atelier <span style='color:#47ACA4'>17</span>.<span style='color:#E77441'>91</span></h1>
                            <p class='lead fw-normal text-white-50 mb-0'>Association qui contribue à des solutions créatives & solidaires, en toute confiance.</p>
                        </div>
                    </div>
                </section>

                <!-- Ateliers -->
                 <section class='bg-white py-5' id='atelier'>
                    <div class='container px-4 px-lg-5 my-5'>
                        <div class='text-center text-dark'>
                            <h1 class='display-4 fw-bolder' style='text-decoration: underline #47ACA4'>Ateliers</h1>
                            <p class='lead fw-normal text-black-50 mb-0'>L'association propose de nombreux ateliers pour venir en aide <br>aux personnes en situation de précarité ou d'isolement.</p>
                            <br><button type='button' id='ate' class='btn btn-dark'>Découvrez nos ateliers</button>
                            <section class='bg-white py-5' style='display:none' id='toggle'>
    <div class='container px-4 my-5'>
        <div class='text-center text-dark'>
            <img src="$root/Img/categories/1.png">
            <h1>Beauté inclusive</h1>
            <p class='lead fw-normal text-dark-50 mb-0'>Création de soins naturels.
                Développement de l'estime de soi.
                Confiance et bien-être.</p>
        </div>
        <div class='text-center text-dark'>
            <img src="$root/Img/categories/2.png">
            <h1>Bijoux recyclés</h1>
            <p class='lead fw-normal text-dark-50 mb-0'>Création de bijou fait-main.
                Sensibilisation à la surconsommation.
                Créations personnalisées.</p>
        </div>
        <div class='text-center text-dark'>
            <img src="$root/Img/categories/3.png">
            <h1>Décoration</h1>
            <p class='lead fw-normal text-dark-50 mb-0'>Réutilisation de matériaux.
                Destinés à être jetés.
                Créations uniques.</p>
        </div>
        <div class='text-center text-dark'>
            <img src="$root/Img/categories/4.png">
            <h1>Produits ménagers</h1>
            <p class='lead fw-normal text-dark-50 mb-0'>Création de produits naturels.
                Sensibilisation aux produits nocifs et sur-emballés.</p>
        </div>
        <div class='text-center text-dark'>
            <img src="$root/Img/categories/5.png">
            <h1>Upcycling</h1>
            <p class='lead fw-normal text-dark-50 mb-0'>Développement durable.
                Sensibilisation au gaspillage textile.
                Créativité.</p>
        </div>
    </div>
</section>
                        </div>
                    </div>
                </section>

                <!-- CustomBox -->
                <section class='bg-dark py-5' id='custom'>
                    <div class='container px-4 px-lg-5 my-5'>
                        <div class='text-center text-white'>
                            <h1 class='display-4 fw-bolder' style='text-decoration: underline #E77441'>CustomBox</h1>
                            <p class='lead fw-normal text-white-50 mb-0'>Créez votre box personnalisée avec nos produits <br>pour vous ou pour offrir.</p>
                            <br><button type='button' class='btn btn-light' onclick="window.location.href='$path/#prods';">Composez votre box!</button>
                        </div>
                    </div>
                </section>

        <!-- Produits -->
        <section class='bg-white py-5' id='prods'>
                    <div class='container px-4 px-lg-5 my-5'>
                        <div class='text-center text-dark'>
                            <h1 class='display-4 fw-bolder' style='text-decoration: underline #47ACA4'>Produits</h1>
                            <p class='lead fw-normal text-dark-50 mb-0'>Découvrez nos produits créés grâce à des matériaux de récup <br>ou proposés à la donation.</p>
                            <!-- Section-->
                                    <section class='py-5'>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Rechercher un produit</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                        <div class='container px-4 px-lg-5 mt-5'>
                                            <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>
                                                $content
                                            </div>
                                        </div>
                                    </section>
                        </div>
                    </div>
                </section>

<!-- Footer-->
        <footer class='py-5 bg-dark'>
            <div class='container'><p class='m-0 text-center text-white'>IUT CHARLEMAGNE <br>&copy; Chevaleyre - Pruliere - Maion - Leblanc - Jarosz</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
        <!-- Core theme JS-->
        <script src='$root/js/scripts.js'></script>
        <script src='$root/js/toggledisplay.js'></script>
    </body>
</html>

END;

    return $html;
}

}