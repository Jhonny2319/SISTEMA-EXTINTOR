<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");

$busca = "";

if(isset($_GET['busca'])){
    $busca = $_GET['busca'];
}

$sql = "SELECT * FROM avcb
WHERE cliente LIKE '%$busca%'
OR localizacao LIKE '%$busca%'

ORDER BY data_validade ASC";

$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Lista AVCB</title>

<link rel="stylesheet" href="css/style.css">

<style>

.status-ok{
    color:limegreen;
    font-weight:bold;
}

.status-vencido{
    color:red;
    font-weight:bold;
}

.status-alerta{
    color:orange;
    font-weight:bold;
}

.botao-voltar{
    background:#222;
    color:white;
    padding:10px 20px;
    text-decoration:none;
    border-radius:5px;
}

.botao-voltar:hover{
    background:black;
}

</style>

</head>

<body>

<div class="menu">

<a href="index.php">Início</a>
<a href="clientes.php">Clientes</a>
<a href="avcb.php">AVCB</a>
<a href="listar_avcb.php">Lista AVCB</a>

</div>

<h1>Lista AVCB</h1>

<a href="index.php" class="botao-voltar">

🏠 Voltar ao Início

</a>

<br><br>

<form method="GET">

<input 
type="text" 
name="busca" 
placeholder="Pesquisar AVCB..."
class="campo"
autocomplete="off">

<button type="submit">

Buscar

</button>

</form>

<table class="tabela">

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Telefone</th>
<th>Endereço</th>
<th>Localização</th>
<th>Validade</th>
<th>Status</th>
<th>Visualizar</th>

</tr>

<?php while($dados = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td>

<?php echo $dados['id']; ?>

</td>

<td>

<?php echo $dados['cliente']; ?>

</td>

<td>

<?php echo $dados['telefone']; ?>

</td>

<td>

<?php echo $dados['localizacao']; ?>

</td>

<td>

<?php echo $dados['localizacao']; ?>

</td>

<td>

<?php echo date('d/m/Y', strtotime($dados['data_validade'])); ?>

</td>

<td>

<?php

$validade = strtotime($dados['data_validade']);

$hoje = strtotime(date('Y-m-d'));

$diferenca = ($validade - $hoje) / (60 * 60 * 24);

if($diferenca < 0){

echo "<span class='status-vencido'>
Vencido
</span>";

}
elseif($diferenca <= 30){

echo "<span class='status-alerta'>
Vence em breve
</span>";

}
else{

echo "<span class='status-ok'>
OK
</span>";

}

?>

</td>

<td>

<a href="detalhes_avcb.php?id=<?php echo $dados['id']; ?>">

Visualizar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>