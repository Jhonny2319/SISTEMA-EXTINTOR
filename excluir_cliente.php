<?php

include("conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM clientes WHERE id = $id";

if(mysqli_query($conexao, $sql)){

    header("Location: clientes.php");

}else{

    echo "Erro ao excluir cliente.";

}

?>