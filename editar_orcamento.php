<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM orcamentos WHERE id='$id'";

$resultado = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($resultado);


if($_SERVER["REQUEST_METHOD"] == "POST"){

$numero_orcamento = $_POST['numero_orcamento'];

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

$sql_update = "UPDATE orcamentos SET

numero_orcamento='$numero_orcamento',
cliente='$cliente',
cnpj='$cnpj',
endereco='$endereco',
quantidade='$quantidade',
valor_unitario='$valor_unitario',
descricao='$descricao',
valor='$valor',
pagamento='$pagamento',
validade='$validade',
observacoes='$observacoes'

WHERE id='$id'";

mysqli_query($conexao, $sql_update);

header("Location: listar_orcamentos.php");

exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Editar Orçamento</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: #111;
}

.card{
    border-radius: 15px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4">

<h2 class="text-warning mb-4">
Editar Orçamento
</h2>

<form method="POST">

<label>Número do Orçamento</label>

<input type="text"
name="numero_orcamento"
class="form-control"
value="<?php echo $dados['numero_orcamento']; ?>">

<br>

<label>Cliente</label>

<input type="text"
name="cliente"
class="form-control"
value="<?php echo $dados['cliente']; ?>">

<br>

<label>CNPJ</label>

<input type="text"
name="cnpj"
class="form-control"
value="<?php echo $dados['cnpj']; ?>">

<br>

<label>Endereço</label>

<input type="text"
name="endereco"
class="form-control"
value="<?php echo $dados['endereco']; ?>">

<br>

<label>Quantidade</label>

<input type="number"
name="quantidade"
id="quantidade"
class="form-control"
value="<?php echo $dados['quantidade']; ?>">

<br>

<label>Valor Unitário</label>

<input type="number"
step="0.01"
name="valor_unitario"
id="valor_unitario"
class="form-control"
value="<?php echo $dados['valor_unitario']; ?>">

<br>

<label>Descrição do Serviço</label>

<textarea
name="descricao"
class="form-control"
rows="5"><?php echo $dados['descricao']; ?></textarea>

<br>

<label>Valor Total</label>

<input type="text"
name="valor"
id="valor"
class="form-control"
value="<?php echo $dados['valor']; ?>"
readonly>

<br>

<label>Forma de Pagamento</label>

<input type="text"
name="pagamento"
class="form-control"
value="<?php echo $dados['pagamento']; ?>">

<br>

<label>Validade do Orçamento</label>

<input type="date"
name="validade"
class="form-control"
value="<?php echo $dados['validade']; ?>">

<br>

<label>Observações</label>

<textarea
name="observacoes"
class="form-control"
rows="4"><?php echo $dados['observacoes']; ?></textarea>

<br>

<button type="submit"
class="btn btn-warning w-100">

Salvar Alterações

</button>

</form>

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