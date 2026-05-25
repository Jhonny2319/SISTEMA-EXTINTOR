<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM avcb WHERE id='$id'";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);


if($_SERVER["REQUEST_METHOD"] == "POST"){

$cliente = $_POST['cliente'];
$telefone = $_POST['telefone'];
$numero_avcb = $_POST['numero_avcb'];
$localizacao = $_POST['localizacao'];
$data_emissao = $_POST['data_emissao'];
$data_validade = $_POST['data_validade'];

$sql_update = "UPDATE avcb SET

cliente='$cliente',
telefone='$telefone',
numero_avcb='$numero_avcb',
localizacao='$localizacao',
data_emissao='$data_emissao',
data_validade='$data_validade'

WHERE id='$id'";

mysqli_query($conexao, $sql_update);

header("Location: listar_avcb.php");

exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Editar AVCB</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#111;
}

.card{
border-radius:15px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<h2 class="text-warning mb-4">
Editar AVCB
</h2>

<form method="POST">

<label>Cliente</label>

<input type="text"
name="cliente"
class="form-control"
value="<?php echo $dados['cliente']; ?>">

<br>

<label>Telefone</label>

<input type="text"
name="telefone"
class="form-control"
value="<?php echo $dados['telefone']; ?>">

<br>

<label>Número AVCB</label>

<input type="text"
name="numero_avcb"
class="form-control"
value="<?php echo $dados['numero_avcb']; ?>">

<br>

<label>Localização</label>

<input type="text"
name="localizacao"
class="form-control"
value="<?php echo $dados['localizacao']; ?>">

<br>

<label>Data Emissão</label>

<input type="date"
name="data_emissao"
class="form-control"
value="<?php echo $dados['data_emissao']; ?>">

<br>

<label>Data Validade</label>

<input type="date"
name="data_validade"
class="form-control"
value="<?php echo $dados['data_validade']; ?>">

<br>

<button type="submit"
class="btn btn-warning w-100">

Salvar Alterações

</button>

</form>

</div>

</div>

</body>
</html>