<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM avcb WHERE id='$id'";

mysqli_query($conexao, $sql);

header("Location: listar_avcb.php");

exit;

?>