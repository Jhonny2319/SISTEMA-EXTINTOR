<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");


// TOTAL EXTINTORES
$sql_total = "SELECT COUNT(*) as total FROM extintores";
$resultado_total = mysqli_query($conexao, $sql_total);
$total = mysqli_fetch_assoc($resultado_total);


// VENCIDOS
$sql_vencidos = "SELECT COUNT(*) as vencidos 
FROM extintores 
WHERE validade < CURDATE()";

$resultado_vencidos = mysqli_query($conexao, $sql_vencidos);
$vencidos = mysqli_fetch_assoc($resultado_vencidos);


// PRÓXIMOS DO VENCIMENTO
$sql_proximos = "SELECT COUNT(*) as proximos 
FROM extintores 
WHERE validade >= CURDATE()
AND validade <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

$resultado_proximos = mysqli_query($conexao, $sql_proximos);
$proximos = mysqli_fetch_assoc($resultado_proximos);


// ORÇAMENTOS
$sql_orcamentos = "SELECT COUNT(*) as total_orcamentos FROM orcamentos";
$resultado_orcamentos = mysqli_query($conexao, $sql_orcamentos);
$total_orcamentos = mysqli_fetch_assoc($resultado_orcamentos);


// AVCB
$sql_avcb = "SELECT COUNT(*) as total_avcb FROM avcb";
$resultado_avcb = mysqli_query($conexao, $sql_avcb);
$total_avcb = mysqli_fetch_assoc($resultado_avcb);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistema de Extintores</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: #111;
    color: white;
    background-image: url('img/extintor.jpg');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
}

.overlay{
    background: rgba(0,0,0,0.85);
    min-height: 100vh;
    padding: 20px;
}

.menu a{
    margin-right: 10px;
    margin-bottom: 10px;
}

.card{
    border: none;
    border-radius: 15px;
    color: white;
    box-shadow: 0px 0px 15px rgba(0,0,0,0.5);
    transition: 0.3s;
}

.card:hover{
    transform: scale(1.03);
}

canvas{
    background: white;
    border-radius: 10px;
    padding: 10px;
}

h1{
    font-weight: bold;
}

</style>

</head>

<body>

<div class="overlay">

<div class="menu mb-4">

<div class="mt-3">

<a href="index.php" class="btn btn-dark">

🏠 Voltar ao Início

</a>

</div>
Início
</a>

<a href="clientes.php" class="btn btn-primary">
Clientes
</a>

<a href="extintores.php" class="btn btn-primary">
Extintores
</a>

<a href="listar_extintores.php" class="btn btn-primary">
Lista
</a>

<a href="consulta_vencimentos.php" class="btn btn-info">
Consulta Vencimentos
</a>

<a href="orcamento.php" class="btn btn-danger">
Orçamento
</a>

<a href="listar_orcamentos.php" class="btn btn-danger">
Lista Orçamentos
</a>

<a href="avcb.php" class="btn btn-warning">
AVCB
</a>

<a href="listar_avcb.php" class="btn btn-warning">
Lista AVCB
</a>

<a href="logout.php" class="btn btn-dark">
Sair
</a>

</div>

<h1 class="mb-4">
Sistema de Controle de Extintores e Orçamentos
</h1>

<div class="row">

<div class="col-md-3 mb-3">

<div class="card bg-primary p-3">

<h4>Total Extintores</h4>

<h2>
<?php echo $total['total']; ?>
</h2>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-danger p-3">

<h4>Extintores Vencidos</h4>

<h2>
<?php echo $vencidos['vencidos']; ?>
</h2>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-warning p-3">

<h4>Vence em Breve</h4>

<h2>
<?php echo $proximos['proximos']; ?>
</h2>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-success p-3">

<h4>Total Orçamentos</h4>

<h2>
<?php echo $total_orcamentos['total_orcamentos']; ?>
</h2>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card bg-info p-3">

<h4>Total AVCB</h4>

<h2>
<?php echo $total_avcb['total_avcb']; ?>
</h2>

</div>

</div>

</div>

<div class="mt-5">

<canvas id="graficoExtintores"></canvas>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('graficoExtintores');

new Chart(ctx, {

type: 'bar',

data: {

labels: [

'Total Extintores',
'Vencidos',
'Vence em Breve',
'Orçamentos',
'AVCB'

],

datasets: [{

label: 'Sistema',

data: [

<?php echo $total['total']; ?>,
<?php echo $vencidos['vencidos']; ?>,
<?php echo $proximos['proximos']; ?>,
<?php echo $total_orcamentos['total_orcamentos']; ?>,
<?php echo $total_avcb['total_avcb']; ?>

],

borderWidth: 1

}]

},

options: {

responsive: true,

plugins: {

legend: {
display: true
}

}

}

});

</script>

</body>
</html>