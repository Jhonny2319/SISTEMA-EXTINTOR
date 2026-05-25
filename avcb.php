<?php

include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$cliente = $_POST['cliente'];
$telefone = $_POST['telefone'];
$numero_avcb = $_POST['numero_avcb'];
$localizacao = $_POST['localizacao'];
$data_emissao = $_POST['data_emissao'];
$data_validade = $_POST['data_validade'];
$status = $_POST['status'];

$sql = "INSERT INTO avcb (

cliente,
telefone,
numero_avcb,
localizacao,
data_emissao,
data_validade,
status

) VALUES (

'$cliente',
'$telefone',
'$numero_avcb',
'$localizacao',
'$data_emissao',
'$data_validade',
'$status'

)";

mysqli_query($conexao, $sql);

echo "<script>alert('AVCB cadastrado com sucesso!')</script>";

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Cadastro AVCB</title>

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

<h2 class="text-danger mb-4">
Cadastro AVCB
</h2>

<form method="POST">

<label>Cliente</label>
<input type="text" name="cliente" class="form-control">

<br>

<label>Telefone</label>
<input type="text" name="telefone" class="form-control">

<br>

<label>Número AVCB</label>
<input type="text" name="numero_avcb" class="form-control">

<br>

<label>Localização</label>
<input type="text" name="localizacao" class="form-control">

<br>

<label>Data de Emissão</label>
<input type="date" name="data_emissao" class="form-control">

<br>

<label>Data de Validade</label>
<input type="date" name="data_validade" class="form-control">

<br>

<label>Status</label>

<select name="status" class="form-control">

<option value="Ativo">
Ativo
</option>

<option value="Vencido">
Vencido
</option>

</select>

<br>

<button type="submit" class="btn btn-danger w-100">
Salvar AVCB
</button>

</form>
<div class="mt-3">

<a href="index.php" class="btn btn-dark">

🏠 Voltar ao Início

</a>

</div>

</div>

</div>

</body>
</html>