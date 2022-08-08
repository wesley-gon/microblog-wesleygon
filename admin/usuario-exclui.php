<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
require_once "../vendor/autoload.php";

//$sessao = new ControleDeAcesso;
//$sessao->verificaAcesso();

//$sessao = new ControleDeAcesso;
//$sessao->verificaAcessoAdmin();


// Criado objeto para poder acessar os recursos da classe
$usuario = new Usuario; // não esquecer altoload e do namespace

// Obtenção do id  da URL e passado para o setter
$usuario->setId($_GET['id']);

// somente então executado o metodo de exclusão
$usuario->excluir();

// após exclusão redirecionamos para a tela de lista de usuários
header("location:usuarios.php");
