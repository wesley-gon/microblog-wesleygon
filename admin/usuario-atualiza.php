<?php
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$usuario = new Usuario;
$usuario->setId($_GET['id']);
$dados = $usuario->listarUM();



if(isset($_POST['atualizar'])){
	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setTipo($_POST['tipo']);

	/* algoritimo da senha 
	Se o campo senha no formulário estiver vazio,  siginifca que o usuário NÂO MUDOU A SENHA.	
	*/
	if( empty($_POST['senha']) ){
		$usuario->setSenha($dados['senha']);
	} else{
			/* Caso contrário, se o isiário digitiou alguma coisa no campo senha, precsaremos veridir  o que foi digitadp */
			//$usuario->setSenha()
			$usuario->setSenha( $usuario->verificaSenha($_POST['senha'], $dados['senha']) );
		}


		$usuario->atualizar();
		header("location:usuarios.php");
	}

	



?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$dados['nome']?>" class="form-control" type="text" id="nome" name="nome" required>

			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value=<?=$dados['email']?> class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option <?php if($dados['tipo'] == 'editor') echo " selected " ?>
				value="editor">Editor</option>

					<option <?php if($dados['tipo'] == 'admin') echo " selected " ?> 
					value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

