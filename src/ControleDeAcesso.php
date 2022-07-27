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

    public function login(int $id, string $nome, string $tipo){
        // No momento em que ocorrer o login, adicionamos à sessão variáveis de sessão contendo os dados necessários para o sistema
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;

}

}