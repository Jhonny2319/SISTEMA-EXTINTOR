<?php

include("conexao.php");

$mensagem = "";

if(isset($_POST['usuario'])){

    $usuario = $_POST['usuario'];

    $sql = "SELECT * FROM usuarios
            WHERE usuario = '$usuario'";

    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) > 0){

        header("Location: nova_senha.php?usuario=$usuario");

    }else{

        $mensagem = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Recuperar Conta</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="login-box">

<h1>Recuperar Conta</h1>

<form method="POST">

<label>Usuário</label>

<input
type="text"
name="usuario"
required
class="campo"
autocomplete="off">

<button type="submit">
Continuar
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