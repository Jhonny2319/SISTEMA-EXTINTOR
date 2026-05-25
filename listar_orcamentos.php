<?php

include 'conexao.php';

$pesquisa = "";

if(isset($_GET['pesquisa'])){

    $pesquisa = $_GET['pesquisa'];

    $sql = "SELECT * FROM orcamentos
    WHERE cliente LIKE '%$pesquisa%'";

}else{

    $sql = "SELECT * FROM orcamentos";

}

$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Lista de Orçamentos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: #111;
    color: white;
}

.table{
    background: white;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4 text-danger">
Lista de Orçamentos
</h2>

<a href="orcamento.php" class="btn btn-danger mb-3">
Novo Orçamento
</a>

<a href="index.php" class="btn btn-dark mb-3">

🏠 Voltar ao Início

</a>

<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-10">

<input type="text"
name="pesquisa"
class="form-control"
placeholder="Pesquisar cliente">

</div>

<div class="col-md-2">

<button type="submit"
class="btn btn-primary w-100">

Pesquisar

</button>

</div>

</div>

</form>

<table class="table table-bordered table-hover">

<tr class="table-dark">

<th>ID</th>
<th>Cliente</th>
<th>Valor Total</th>
<th>Entrada</th>
<th>Restante</th>
<th>Status Financeiro</th>
<th>Pagamento</th>
<th>Validade</th>
<th>Ações</th>

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
R$ <?php echo $dados['valor']; ?>
</td>

<td>

R$

<?php

echo isset($dados['valor_entrada'])
? $dados['valor_entrada']
: '0,00';

?>

</td>

<td>

R$

<?php

echo isset($dados['valor_restante'])
? $dados['valor_restante']
: '0,00';

?>

</td>

<td>

<?php

$pagamento = strtolower($dados['pagamento']);

if($pagamento == 'pago'){

echo "<span style='color:limegreen; font-weight:bold;'>
Pago
</span>";

}
elseif($pagamento == 'parcial'){

echo "<span style='color:orange; font-weight:bold;'>
Parcial
</span>";

}
else{

echo "<span style='color:red; font-weight:bold;'>
Em Aberto
</span>";

}

?>

</td>

<td>
<?php echo $dados['pagamento']; ?>
</td>

<td>
<?php echo date('d/m/Y', strtotime($dados['validade'])); ?>
</td>

<td>

<a href="gerar_pdf_orcamento.php?id=<?php echo $dados['id']; ?>"
class="btn btn-primary btn-sm"
target="_blank">

PDF

</a>

<a href="editar_orcamento.php?id=<?php echo $dados['id']; ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<a href="excluir_orcamento.php?id=<?php echo $dados['id']; ?>"
class="btn btn-danger btn-sm">

Excluir

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>