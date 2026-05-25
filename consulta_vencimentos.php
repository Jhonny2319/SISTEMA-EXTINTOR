<?php

include("conexao.php");

$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Consulta de Vencimentos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f4f4;
    padding:20px;
}

table{
    background:white;
}

h2{
    font-weight:bold;
}

</style>

</head>

<body>

<h2 class="mb-4">
Consulta de Vencimentos
</h2>

<form method="GET" class="mb-4">

<select name="mes" class="form-select w-25">

<option value="01" <?php if($mes == '01') echo 'selected'; ?>>
Janeiro
</option>

<option value="02" <?php if($mes == '02') echo 'selected'; ?>>
Fevereiro
</option>

<option value="03" <?php if($mes == '03') echo 'selected'; ?>>
Março
</option>

<option value="04" <?php if($mes == '04') echo 'selected'; ?>>
Abril
</option>

<option value="05" <?php if($mes == '05') echo 'selected'; ?>>
Maio
</option>

<option value="06" <?php if($mes == '06') echo 'selected'; ?>>
Junho
</option>

<option value="07" <?php if($mes == '07') echo 'selected'; ?>>
Julho
</option>

<option value="08" <?php if($mes == '08') echo 'selected'; ?>>
Agosto
</option>

<option value="09" <?php if($mes == '09') echo 'selected'; ?>>
Setembro
</option>

<option value="10" <?php if($mes == '10') echo 'selected'; ?>>
Outubro
</option>

<option value="11" <?php if($mes == '11') echo 'selected'; ?>>
Novembro
</option>

<option value="12" <?php if($mes == '12') echo 'selected'; ?>>
Dezembro
</option>

</select>

<br>

<button type="submit" class="btn btn-primary">
Consultar
</button>

<a href="index.php" class="btn btn-dark">

🏠 Voltar ao Início

</a>

</form>

<table class="table table-bordered table-striped">

<tr>

<th>Cliente</th>
<th>Telefone</th>
<th>Endereço</th>
<th>Tipo</th>
<th>Capacidade</th>
<th>Localização</th>
<th>Validade</th>
<th>Status</th>
<th>Visualizar</th>

</tr>

<?php

// =========================
// EXTINTORES
// =========================

$sql = "SELECT 
extintores.*,
clientes.nome,
clientes.telefone,
clientes.endereco

FROM extintores

INNER JOIN clientes
ON extintores.cliente = clientes.id

WHERE MONTH(extintores.validade) = '$mes'

ORDER BY extintores.validade ASC";

$resultado = mysqli_query($conexao, $sql);

while($dados = mysqli_fetch_assoc($resultado)){

$status = 'Em Dia';
$cor = 'success';

if($dados['validade'] < date('Y-m-d')){

$status = 'Vencido';
$cor = 'danger';

}elseif($dados['validade'] <= date('Y-m-d', strtotime('+30 days'))){

$status = 'Vence em Breve';
$cor = 'warning';

}

?>

<tr>

<td>
<?php echo $dados['nome']; ?>
</td>

<td>
<?php echo $dados['telefone']; ?>
</td>

<td>
<?php echo $dados['endereco']; ?>
</td>

<td>
<?php echo $dados['tipo']; ?>
</td>

<td>
<?php echo $dados['capacidade']; ?>
</td>

<td>
<?php echo $dados['localizacao']; ?>
</td>

<td>
<?php echo date('d/m/Y', strtotime($dados['validade'])); ?>
</td>

<td>

<span class="badge bg-<?php echo $cor; ?>">

<?php echo $status; ?>

</span>

</td>

<td>

<a href="detalhes_extintor.php?id=<?php echo $dados['id']; ?>" 
class="btn btn-primary btn-sm">

Visualizar

</a>

</td>

</tr>

<?php } ?>

<?php

// =========================
// AVCB
// =========================

$sql2 = "SELECT * FROM avcb
WHERE MONTH(data_validade) = '$mes'
ORDER BY data_validade ASC";

$resultado2 = mysqli_query($conexao, $sql2);

while($dados2 = mysqli_fetch_assoc($resultado2)){

$status = 'Em Dia';
$cor = 'success';

if($dados2['data_validade'] < date('Y-m-d')){

$status = 'Vencido';
$cor = 'danger';

}elseif($dados2['data_validade'] <= date('Y-m-d', strtotime('+30 days'))){

$status = 'Vence em Breve';
$cor = 'warning';

}

?>

<tr>

<td>
<?php echo $dados2['cliente']; ?>
</td>

<td>
<?php echo $dados2['telefone']; ?>
</td>

<td>
<?php echo $dados2['localizacao']; ?>
</td>

<td>
AVCB
</td>

<td>
---
</td>

<td>
<?php echo $dados2['localizacao']; ?>
</td>

<td>
<?php echo date('d/m/Y', strtotime($dados2['data_validade'])); ?>
</td>

<td>

<span class="badge bg-<?php echo $cor; ?>">

<?php echo $status; ?>

</span>

</td>

<td>

<a href="listar_avcb.php" 
class="btn btn-warning btn-sm">

Visualizar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>