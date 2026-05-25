<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM orcamentos WHERE id='$id'";

mysqli_query($conexao, $sql);

header("Location: listar_orcamentos.php");

exit;

?>