<?php

$servidor = "127.0.0.1:3307";
$usuario = "root";
$senha = "";
$banco = "escritório";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if(!$conexao){
    die("Erro na conexão: " . mysqli_connect_error());
}

?>