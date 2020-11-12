<?php
session_start(); //inicia sessao
echo "ID: ".session_id()."<br>";
session_unset(); //limpa sessao
session_destroy(); //destroi sessao

echo "limpou e destruio a sessao!"

?>