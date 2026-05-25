<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");

if(isset($_POST['numero_extintor'])){

    $numero_extintor = $_POST['numero_extintor'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $validade = $_POST['validade'];
    $recarga = $_POST['recarga'];
    $localizacao = $_POST['localizacao'];
    $cliente = $_POST['cliente'];

    $sql = "INSERT INTO extintores
    (numero_extintor, tipo, capacidade, validade, recarga, localizacao, cliente)

    VALUES
    ('$numero_extintor', '$tipo', '$capacidade', '$validade', '$recarga', '$localizacao', '$cliente')";

    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Extintor cadastrado com sucesso!')</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Extintores</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>Cadastro de Extintores</h1>

<div class="menu">
    <div class="text-center mb-4">

<img src="img/logo_final.jpg"
width="180">

</div>
    <a href="index.php">Início</a>
    <a href="clientes.php">Clientes</a>
    <a href="extintores.php">Extintores</a>
    <a href="listar_extintores.php">Lista</a>
</div>

<form method="POST">

    <label>Número do Extintor:</label>
    <input type="text" name="numero_extintor" required class="campo">

    <label>Tipo:</label>
    <select name="tipo" required class="campo">
        <option value="">Selecione</option>
        <option value="Água">Água Pressurizada</option>
        <option value="CO2">CO₂</option>
        <option value="Pó Químico">Pó Químico</option>
        <option value="ABC">Pó Químico ABC</option>
    </select>

   <label>Capacidade:</label>
<input type="text" name="capacidade" required class="campo">

<label>Validade:</label>
<input type="date" name="validade" required class="campo">

<label>Recarga:</label>
<input type="date" name="recarga" required class="campo">

<label>Localização:</label>
<input type="text" name="localizacao" required class="campo">

<label>Cliente:</label>

<select name="cliente" required class="campo">
        <?php

        $sql = "SELECT * FROM clientes";
        $resultado = mysqli_query($conexao, $sql);

        while($cliente = mysqli_fetch_assoc($resultado)){

            echo "<option value='".$cliente['id']."'>
                    ".$cliente['nome']."
                  </option>";
        }

        ?>

    </select>

    <button type="submit">Cadastrar</button>
    <a href="index.php" class="btn btn-dark w-100 mt-3">

🏠 Voltar ao Início

</a>

</form>

</body>
</html>