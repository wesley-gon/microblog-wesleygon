<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

// mensagens de feedback relacionadas ao acesso

if( isset($_GET['acesso_proibido']) ) {
	$feedback = 'Você deve estar logado para seguir com a ação <span> <i class="bi bi-emoji-dizzy-fill"></i> </span>';

} elseif( isset($_GET['campos_obrigatorios']) ) {
	$feedback = 'Você deve preencher os dois campos! <i class="bi bi-menu-button-fill"></i> ';
}
elseif( isset($_GET['nao_encontrado']) ) {
	$feedback = 'Este usuário não existe no banco de dados <i class="bi bi-sign-stop"></i> ';
}
elseif( isset($_GET['senha_incorreta']) ) {
	$feedback = 'Os dados estão incorretos, tente novamente <i class="bi bi-slash-circle-fill"></i> ';
}
elseif( isset($_GET['logout']) ) {
	$feedback = 'Você saiu da área logada <i class="bi bi-x-square-fill"></i> ';
}


?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <?php if(isset($feedback)){?>
				<p  class="my-2 alert alert-warning text-center"> <?=$feedback?>
				</p>
                <?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>


<?php
if( isset($_POST['entrar']) ){

	//verificação de campos do forumário
	if(empty($_POST['email']) || empty($_POST['senha']) ){
		header("location:login.php?campos_obrigatorios");
	} else {
		// capiturando o e-mail informado
		$usuario = new Usuario;
		$usuario->setEmail($_POST['email']);

		// Consulta que vai buscar se o usuário esta no banco a partir do e-mail selecionado
		$dados = $usuario->buscar();
		
		// se dados for falso., ou seja, não tem dados cadastrados do e-mail informado.
		if(!$dados) {
			//então  fica no login e da uma feedback
			header("location:login.php?nao_encontrado");
			//echo "Não tem nínguem com estes dados!"; (usado para testar)
		} else {
			// Verificação da senha e login 
			if( password_verify($_POST['senha'], $dados['senha']) ){
				//Estando certo, será feito o login
				$sessao = new ControleDeAcesso;
				$sessao->login($dados['id'], $dados['nome'], $dados['tipo']);
				header("location:admin/index.php");
			} else {
				//Caso contrário, mantenha na pagina e login e apresente uma mensagem
				header("location:login.php?senha_incorreta");
			}
		}

	}
}

?>
    </div>
    
    
</div>        
        
        
    



<?php 
require_once "inc/rodape.php";
?>

