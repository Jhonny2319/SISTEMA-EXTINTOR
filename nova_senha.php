<?php

include("conexao.php");

$mensagem = "";

$usuario = $_GET['usuario'];

if(isset($_POST['nova_senha'])){

    $nova_senha = $_POST['nova_senha'];

    $sql = "UPDATE usuarios
            SET senha = '$nova_senha'
            WHERE usuario = '$usuario'";

    if(mysqli_query($conexao, $sql)){

        $mensagem = "Senha alterada com sucesso!";

    }else{

        $mensagem = "Erro ao alterar senha!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Nova Senha</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="login-box">

<h1>Criar Nova Senha</h1>

<form method="POST">

<label>Nova Senha</label>

<input
type="password"
name="nova_senha"
required
class="campo"
autocomplete="off">

<button type="submit">
Salvar Nova Senha
</button>

<br><br>

<a href="login.php">
Voltar para Login
</a>

</form>

<?php

if($mensagem != ""){

    echo "<div style='
    background:white;
    color:black;
    padding:15px;
    border-radius:10px;
    margin-top:20px;
    font-weight:bold;
    '>

    $mensagem

    </div>";
}

?>

</div>

</div>

</body>
</html>