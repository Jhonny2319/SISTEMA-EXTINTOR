<?php

include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM avcb WHERE id='$id'";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Detalhes AVCB</title>

<link rel="stylesheet" href="css/style.css">

<style>

.container{

width:80%;
margin:auto;
background:white;
padding:30px;
margin-top:30px;
border-radius:10px;

}

h1{
margin-bottom:30px;
}

.info{
margin-bottom:15px;
font-size:18px;
}

.botao{
background:#222;
color:white;
padding:10px 20px;
text-decoration:none;
border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<h1>Detalhes AVCB</h1>

<div class="info">
<b>Cliente:</b>
<?php echo $dados['cliente']; ?>
</div>

<div class="info">
<b>Telefone:</b>
<?php echo $dados['telefone']; ?>
</div>

<div class="info">
<b>Número AVCB:</b>
<?php echo $dados['numero_avcb']; ?>
</div>

<div class="info">
<b>Localização:</b>
<?php echo $dados['localizacao']; ?>
</div>

<div class="info">
<b>Data Emissão:</b>
<?php echo date('d/m/Y', strtotime($dados['data_emissao'])); ?>
</div>

<div class="info">
<b>Data Validade:</b>
<?php echo date('d/m/Y', strtotime($dados['data_validade'])); ?>
</div>

<div class="info">
<b>Status:</b>
<?php echo $dados['status']; ?>
</div>

<a href="listar_avcb.php" class="botao">

⬅ Voltar

</a>

</div>

</body>
</html>