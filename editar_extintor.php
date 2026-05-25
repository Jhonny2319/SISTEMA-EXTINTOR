<?php
session_start();

if(!isset($_SESSION['usuario'])){

header("Location: login.php");

}

include("conexao.php");

$id = $_GET['id'];

if(isset($_POST['numero_extintor'])){

    $numero_extintor = $_POST['numero_extintor'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $validade = $_POST['validade'];
    $recarga = $_POST['recarga'];
    $localizacao = $_POST['localizacao'];
    $cliente = $_POST['cliente'];

    $sql = "UPDATE extintores SET
    numero_extintor = '$numero_extintor',
    tipo = '$tipo',
    capacidade = '$capacidade',
    validade = '$validade',
    recarga = '$recarga',
    localizacao = '$localizacao',
    cliente = '$cliente'
    WHERE id = $id";

    mysqli_query($conexao, $sql);

    echo "Extintor atualizado com sucesso!";
}

$sql = "SELECT * FROM extintores WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Extintor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="menu">
    <a href="index.php">Início</a>
    <a href="clientes.php">Clientes</a>
    <a href="extintores.php">Extintores</a>
    <a href="listar_extintores.php">Lista</a>
</div>


<h1>Editar Extintor</h1>

<form method="POST">

<label>Número do Extintor:</label><br>
<input type="text" name="numero_extintor"
value="<?php echo $dados['numero_extintor']; ?>"><br><br>

<label>Tipo:</label><br>
<input type="text" name="tipo"
value="<?php echo $dados['tipo']; ?>"><br><br>

<label>Capacidade:</label><br>
<input type="text" name="capacidade"
value="<?php echo $dados['capacidade']; ?>"><br><br>

<label>Validade:</label><br>
<input type="date" name="validade"
value="<?php echo $dados['validade']; ?>"><br><br>

<label>Recarga:</label><br>
<input type="date" name="recarga"
value="<?php echo $dados['recarga']; ?>"><br><br>

<label>Localização:</label><br>
<input type="text" name="localizacao"
value="<?php echo $dados['localizacao']; ?>"><br><br>

<label>Cliente:</label><br>
<input type="text" name="cliente"
value="<?php echo $dados['cliente']; ?>"><br><br>

<button type="submit">Atualizar</button>

</form>

</body>
</html>