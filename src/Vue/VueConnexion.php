<?php

namespace custumbox\Vue;

define('SCRIPT_ROOT', 'http://localhost/CrazyCharlyDay/CustomBox/Ressources');
class VueConnexion
{
    private $error;

    function __construct($rq, $error = NULL)
    {
        $this->rq = $rq;
        $this->error = $error;
    }

    public function render()
    {
            $content = $this->creerVueConnexion();
            if (isset($this->error)) {
                $content .= $this->addError();
            }
            $html = new Vue($content, 'Connexion', $this->rq);
            return $html->getHtml();
    }

    public function creerVueConnexion()
    {
        $root = SCRIPT_ROOT;
        $host = $this->rq->getUri()->getBasePath();
        $res = <<<END
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
        <link href='/Css/styles.css' rel='stylesheet' />
     </head>
        <body>
    <div class="container">
        <div class="row">
            <div class="col-6 p-3">
                <form action="$host/connexion/connex" method="POST">
                    <h3> Se connecter </h3>
                    <div class="row">
                        <div class="col">
                            <label for="connecnomListe">Nom</label>
                            <input id="connecnomListe" type="text" name="name" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col">
                            <label for="connecmotDePasse">Mot de Passe</label>
                            <input id="connecmotDePasse" type="password" name="password" class="form-control" placeholder="Mot De Passe">
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <button class="btn btn-lg btn-outline-dark" type="submit">Se connecter</button>
                        </div>        
                    </div>
                </form>
            </div>
            <div class="col-6 p-3">
                <form action="$host/connexion/crea" method="POST">
                    <h3> Cr??er un compte </h3>
                    <div class="row">
                        <div class="col">
                            <label for="nomListe">Nom</label>
                            <input id="nomListe" type="text" name="name" class="form-control" placeholder="Nom">
                        </div>
                        <div class="col">
                            <label for="nomListe">Pr??nom</label>
                            <input id="nomListe" type="text" name="surname" class="form-control" placeholder="Pr??nom">
                        </div>
                        <div class="col">
                            <label for="motDePasse">Mot de Passe</label>
                            <input id="motDePasse" type="password" name="password" class="form-control" placeholder="Mot De Passe">
                        </div>
                        <div class="col">
                            <label for="nomListe">Mail</label>
                            <input id="nomListe" type="text" name="mail" class="form-control" placeholder="Mail">
                        </div>
                        <div class="col">
                            <label for="nomListe">Num??ro de T??l??phone</label>
                            <input id="nomListe" type="text" name="phone" class="form-control" placeholder="T??l??phone">
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <button class="btn btn-lg btn-outline-dark" type="submit">Cr??er</button>
                        </div>        
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <footer class='py-5 bg-dark'>
            <div class='container'><p class='m-0 text-center text-white'>IUT CHARLEMAGNE <br>&copy; Chevaleyre - Pruliere - Maion - Leblanc - Jarosz</p></div>
        </footer>
    </body>
</html>
END;

        return $res;
    }

    /**
     * Fonction qui permet l'affichage des erreurs
     */
    public function addError()
    {
        if ($this->error == 1) {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Il semblerait que l'un des ??l??ments comporte une erreur. Veuillez les v??rifier.
                </div>
            </div>
END;
        } else if ($this->error == 2) {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Il semblerait que votre mot de passe ne soit pas assez long ! Il doit faire plus de 10 caract??res.
                </div>
            </div>
END;
        } else if ($this->error == 3) {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Mot de passe incorrect.
                </div>
            </div>
END;
        } else if ($this->error == 4) {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Pas d'identifiant correspondant.
                </div>
            </div>
END;
        } else if ($this->error == 5) {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Identifiant d??j?? utilis?? ! Veuillez en choisir un autre.
                </div>
            </div>
END;
        } else {
            $res = <<<END
            <hr>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Connect?? !
                </div>
            </div>
END;
        }
        return $res;
    }



    public function creerVueConnecte() {
        $host = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
        $res = <<<END
        <div class="container">
        
        </div>
END;
        return $res;
    }

}
