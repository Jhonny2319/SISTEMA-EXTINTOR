<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM extintores WHERE id = '$id'";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Detalhes do Extintor</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="menu">

    <a href="index.php">Início</a>
    <a href="clientes.php">Clientes</a>
    <a href="extintores.php">Extintores</a>
    <a href="listar_extintores.php">Lista</a>

</div>

<h1>Detalhes do Extintor</h1>

<div class="detalhes-box">

    <p><strong>ID:</strong> <?php echo $dados['id']; ?></p>

    <p><strong>Número:</strong> <?php echo $dados['numero_extintor']; ?></p>

    <p><strong>Tipo:</strong> <?php echo $dados['tipo']; ?></p>

    <p><strong>Capacidade:</strong> <?php echo $dados['capacidade']; ?></p>

    <p><strong>Validade:</strong> <?php echo date('d/m/Y', strtotime($dados['validade'])); ?></p>

    <p><strong>Recarga:</strong> <?php echo date('d/m/Y', strtotime($dados['recarga'])); ?></p>

    <p><strong>Localização:</strong> <?php echo $dados['localizacao']; ?></p>

    <p><strong>Cliente:</strong> <?php echo $dados['cliente']; ?></p>

</div>

</body>
</html>