<?php
include("conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM extintores WHERE id = $id";

if(mysqli_query($conexao, $sql)){
    echo "Extintor excluído com sucesso!";
} else {
    echo "Erro ao excluir!";
}
?>

<br><br>

<a href="listar_extintores.php">Voltar</a>