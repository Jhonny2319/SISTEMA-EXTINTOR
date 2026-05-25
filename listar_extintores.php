<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");

$busca = "";
$mes = "";

// BUSCA
if(isset($_GET['busca'])){
    $busca = $_GET['busca'];
}

// FILTRO MÊS
if(isset($_GET['mes'])){
    $mes = $_GET['mes'];
}

// CONSULTA SQL
$sql = "SELECT * FROM extintores
WHERE (
numero_extintor LIKE '%$busca%'
OR cliente LIKE '%$busca%'
OR localizacao LIKE '%$busca%'
)";

// FILTRO POR MÊS
if($mes != ""){

$sql .= " AND MONTH(validade) = '$mes'";

}

$sql .= " ORDER BY validade ASC";

$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Lista de Extintores</title>

<link rel="stylesheet" href="css/style.css">

<style>

.filtro-mes{
    margin-top:20px;
    margin-bottom:20px;
}

.botao-voltar{
    background:#222;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    border-radius:5px;
    margin-left:10px;
}

.botao-voltar:hover{
    background:#000;
}

</style>

</head>

<body>

<div class="menu">

<a href="index.php">Início</a>
<a href="clientes.php">Clientes</a>
<a href="extintores.php">Extintores</a>
<a href="listar_extintores.php">Lista</a>

</div>

<h1>Lista de Extintores</h1>

<a href="pdf_extintores.php" target="_blank">

<button style="width:200px; margin-bottom:20px;">

Gerar PDF

</button>

</a>

<a href="index.php" class="botao-voltar">

🏠 Voltar ao Início

</a>

<!-- FILTRO POR MÊS -->

<form method="GET" class="filtro-mes">

<select name="mes" class="campo">

<option value="">Todos os Meses</option>

<option value="01">Janeiro</option>
<option value="02">Fevereiro</option>
<option value="03">Março</option>
<option value="04">Abril</option>
<option value="05">Maio</option>
<option value="06">Junho</option>
<option value="07">Julho</option>
<option value="08">Agosto</option>
<option value="09">Setembro</option>
<option value="10">Outubro</option>
<option value="11">Novembro</option>
<option value="12">Dezembro</option>

</select>

<button type="submit">

Consultar Vencimentos

</button>

</form>

<!-- PESQUISA -->

<form method="GET">

<input 
type="text" 
name="busca" 
placeholder="Pesquisar extintor..."
class="campo"
autocomplete="off">

<button type="submit">

Buscar

</button>

</form>

<table class="tabela">

<tr>

<th>ID</th>
<th>Número</th>
<th>Tipo</th>
<th>Capacidade</th>
<th>Validade</th>
<th>Status</th>
<th>Recarga</th>
<th>Localização</th>
<th>Cliente</th>
<th>Ações</th>

</tr>

<?php while($dados = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td>

<?php echo $dados['id']; ?>

</td>

<td>

<a href="detalhes_extintor.php?id=<?php echo $dados['id']; ?>">

<?php echo $dados['numero_extintor']; ?>

</a>

</td>

<td>

<?php echo $dados['tipo']; ?>

</td>

<td>

<?php echo $dados['capacidade']; ?>

</td>

<td>

<?php echo date('d/m/Y', strtotime($dados['validade'])); ?>

</td>

<td>

<?php

$validade = strtotime($dados['validade']);

$hoje = strtotime(date('Y-m-d'));

$diferenca = ($validade - $hoje) / (60 * 60 * 24);

if($diferenca < 0){

echo "<span style='color:red; font-weight:bold;'>
Vencido
</span>";

}
elseif($diferenca <= 30){

echo "<span style='color:orange; font-weight:bold;'>
Vence em breve
</span>";

}
else{

echo "<span style='color:lime; font-weight:bold;'>
OK
</span>";

}

?>

</td>

<td>

<?php echo date('d/m/Y', strtotime($dados['recarga'])); ?>

</td>

<td>

<?php echo $dados['localizacao']; ?>

</td>

<td>

<?php echo $dados['cliente']; ?>

</td>

<td>

<a href="editar_extintor.php?id=<?php echo $dados['id']; ?>">

Editar

</a>

|

<a href="excluir_extintor.php?id=<?php echo $dados['id']; ?>">

Excluir

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>