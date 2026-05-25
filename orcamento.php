<?php

include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

$numero_orcamento = $_POST['numero_orcamento'];

$valor_entrada = $_POST['valor_entrada'];

$valor_restante = $_POST['valor_restante'];

$status_pagamento = $_POST['status_pagamento'];

$cliente = $_POST['cliente'];

$cnpj = $_POST['cnpj'];

$endereco = $_POST['endereco'];

$quantidade = $_POST['quantidade'];

$valor_unitario = $_POST['valor_unitario'];

$descricao = $_POST['descricao'];

$valor = $_POST['valor'];

$pagamento = $_POST['pagamento'];

$validade = $_POST['validade'];

$observacoes = $_POST['observacoes'];

$status = $_POST['status'];

$sql = "INSERT INTO orcamentos (

numero_orcamento,
cliente,
cnpj,
endereco,
quantidade,
valor_unitario,
descricao,
valor,
pagamento,
valor_entrada,
valor_restante,
status_pagamento,
validade,
observacoes,
status

) VALUES (

'$numero_orcamento',
'$cliente',
'$cnpj',
'$endereco',
'$quantidade',
'$valor_unitario',
'$descricao',
'$valor',
'$pagamento',
'$valor_entrada',
'$valor_restante',
'$status_pagamento',
'$validade',
'$observacoes',
'$status'

)";

mysqli_query($conexao, $sql);

$id = mysqli_insert_id($conexao);

header("Location: gerar_pdf_orcamento.php?id=$id");

exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Orçamento</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#111;
}

.card{
border-radius:20px;
border:none;
box-shadow:0 0 25px rgba(0,0,0,0.2);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<div class="text-center mb-4">

<img src="img/logo_final.jpg" width="180">

</div>

<h2 class="text-danger mb-4">
Novo Orçamento
</h2>

<form method="POST">

<label>Número do Orçamento</label>

<input type="text"
name="numero_orcamento"
class="form-control">

<br>

<label>Cliente</label>

<input type="text"
name="cliente"
class="form-control"
required>

<br>

<label>CNPJ</label>

<input type="text"
name="cnpj"
class="form-control">

<br>

<label>Endereço</label>

<input type="text"
name="endereco"
class="form-control">

<br>

<label>Quantidade</label>

<input type="number"
name="quantidade"
id="quantidade"
class="form-control">

<br>

<label>Valor Unitário</label>

<input type="number"
step="0.01"
name="valor_unitario"
id="valor_unitario"
class="form-control">

<br>

<label>Descrição do Serviço</label>

<textarea
name="descricao"
class="form-control"
rows="5"
required></textarea>

<br>

<label>Valor Total</label>

<input type="text"
name="valor"
id="valor"
class="form-control"
readonly>

<br>

<label>Forma de Pagamento</label>

<input type="text"
name="pagamento"
class="form-control">

<br>

<label>Valor de Entrada</label>

<input 
type="text" 
name="valor_entrada"
class="form-control">

<br>

<label>Valor Restante</label>

<input 
type="text" 
name="valor_restante"
class="form-control">

<br>

<label>Status do Pagamento</label>

<select name="status_pagamento" class="form-control">

<option value="Em Aberto">
Em Aberto
</option>

<option value="Parcial">
Parcial
</option>

<option value="Pago">
Pago
</option>

</select>

<br>

<label>Validade do Orçamento</label>

<input type="date"
name="validade"
class="form-control">

<br>

<label>Status</label>

<select name="status" class="form-control">

<option value="Pendente">
Pendente
</option>

<option value="Aprovado">
Aprovado
</option>

<option value="Recusado">
Recusado
</option>

</select>

<br>

<label>Observações</label>

<textarea
name="observacoes"
class="form-control"
rows="4"></textarea>

<br>

<button type="submit"
class="btn btn-danger w-100">

Gerar Orçamento PDF

</button>

</form>

<a href="index.php" class="btn btn-dark w-100 mt-3">

🏠 Voltar ao Início

</a>

</div>

</div>

<script>

const quantidade =
document.getElementById('quantidade');

const valorUnitario =
document.getElementById('valor_unitario');

const valor =
document.getElementById('valor');

function calcular(){

let qnt = parseFloat(quantidade.value) || 0;

let unit = parseFloat(valorUnitario.value) || 0;

valor.value = (qnt * unit).toFixed(2);

}

quantidade.addEventListener('input', calcular);

valorUnitario.addEventListener('input', calcular);

</script>

</body>
</html>