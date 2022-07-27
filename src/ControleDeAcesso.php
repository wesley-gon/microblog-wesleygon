<?php
namespace Microblog;

final class ControleDeAcesso {

    public function __construct()
    {
        /* Verificar se não existe uma sessão em funcionmaneto */
        if( !isset($_SESSION)){
            // então iniciamos a sessão
            session_start();       

        }
    }

    public function verificaAcesso():void {
        // se não existir uma variável de sessão rlacionada ao id do usuário logado (ou seja ninguém logado)
        if( !isset($_SESSION['id']) ) {
            //Então significa que o usuário não esta logado, portanto apague respício de sesão e force o usuário a ir para login.php
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die(); //exit
        }
    }

}