<?php

namespace custumbox\Vue;

use custumbox\controller\Authentification;

class VueUtilisateur
{

    private $html;

    public function __Construct($rq)
    {
        $page = $this->setTemplate($rq);
        $this->html = $page;
    }

    public function render() {
        $this->gethtml();
    }

    public function setTemplate($rq) {
        $path = $rq->getUri()->getBasePath();
        if(Authentification::isConnected()){
            $name = $_SESSION['user']['name'];
            $surname = $_SESSION['user']['surname'];
            $mail = $_SESSION['user']['mail'];
            $phone = $_SESSION['user']['phone'];
            $content = <<<END
            <p>$name</p>
            <p>$surname</p>
            <p>$mail</p>
            <p>$phone</p>
END;
        } else {
            $content = <<<END
<p> vous n'êtes pas connecter<p>
END;
        }
        $temp = <<<END
         <!DOCTYPE html> <html>
          <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="icon" href="$path/img/logos/logoBlanc.png" />
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
          </head>
        <body>
        
        $content

         </body>
        <html>
END;
        return $temp;
    }

    public function getHtml()
    {
        return $this->html;
    }

}