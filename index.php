<?php/
//conexao BD
require_once 'db_connect.php';
//sessão
session_start();

//botão enviar
if (isset($_POST['btn-entrar'])): //quando clicar no botão
	$erros = array(); //cria uma array de erros 
	$login = mysqli_escape_string($connect, $_POST['login']); //atribui a vaeiavel login, a variavel login q esta no post
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	
	
	if (empty($login) or empty($senha)): //verifica se os campos estão vazios
		$erros[] = "<li> O campo login/senha prescisa ser preenchido </li>"; //se o campo estiver vazio, guarda o erro no array
		else:  //se nao estiver vazio
			$sql = "SELECT login FROM usuarios WHERE login = '$login'"; //atribui a variavel sql um comando string SQL que consulta se o login existe no BD
			$resultado = mysqli_query($connect, $sql);
			
			if(mysqli_num_rows($resultado)>0): //se ouver algum registro
				$senha = Md5($senha); //criptografa a senha
				$sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = $senha"; //atribui a variavel sql um comando string SQL que consulta se o login e a senha são iguais ao que existe no BD
				$resultado = mysqli_query($connect, $sql);
					if(mysqli_num_rows($resultado)==1): 
						$dados = mysqli_fetch_array($resultado); //mysqli_fetch_array vai converter o $resultado em um array e atribuir a variavel dados
						$_session['logado'] = true;
						$_session['id_usuario'] = $dados['id'];
					else:
						$erros[] = "<li> Usuario ou senha invalidos! </li>";
					endif;
				
			else:
				$erros[] = "<li> Esse usuarios nao existe!</li>";
			endif;
		// continua.... Se o array erros não estiver vazio, exibe os erros
	endif;
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title> Login </title>
    	<meta name="description" content=".">
    	<meta name="keywords" content="aplicativo de nutrição">
    	<meta name="robots" content="index, follow">
    	<meta name="author" content="Editado - Bruna Goulart">
    	<link rel="stylesheet" href="css/style.css">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    	<link rel="icon" href="img/icon.jpg">
    </head>
    <body>
        
		<!-- LOGIN USUARIO -->
		
		<div class="login container">
		<h1 style = "font-family:Georgia, serif">NutriBEM</h1>
		<a href="#"><img src="img/logo.png" alt="logo"></a>
		
		<?php
			//...continuação
			if (!empty($erros)): //Se não tiver nenhum erro no array de arros
				foreach($erros as $erro): // para cada item do array, ele vai atribui um item a variavel erro
					echo $erro; //e vai imprimir a variavel erro
				endforeach;
			endif;
		?>
		<form name="login"action="" method="post">
			<h3>Faça login para acessar sua conta!</h3>
			<input type ="text" name= "login" placeholder = "Seu login"/>
			<input type ="password" name= "senha" placeholder = "Sua senha"/>
			<input type ="submit" name= "btn-entrar" value = "Enviar"/>
			<a href="#">Cadastrar-se</a>
		</form>	
		
		</div>             
    </body>
</html>