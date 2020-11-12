<?php
//dados do banco
$servername = "localhost";
$username = "brunagoulart";
$password  = "BngDdb250115";
$db_name = "sistemaLogin";

//conexão com o banco de dados
$connect = mysqli_connect($servername,$username,$password,$db_name);

if (mysqli_connect_error()):
	echo "falha na conexão: ".mysqli_connect_error();
endif;
?>