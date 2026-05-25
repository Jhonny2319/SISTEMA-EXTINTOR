<?php
session_start();

include("conexao.php");

if(isset($_POST['usuario'])){

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios
            WHERE usuario='$usuario'
            AND senha='$senha'";

    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $_SESSION['usuario'] = $usuario;

        header("Location: index.php");

    }else{

        echo "<script>alert('Usuário ou senha inválidos!')</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">
<div class="text-center mb-4">

<img src="img/logo_final.jpg"
width="180">

</div>

<div class="login-box">

<h1>Login do Sistema</h1>

<form method="POST">

<label>Usuário</label>

<input 
type="text" 
name="usuario" 
placeholder="Digite seu usuário"
required
class="campo"
autocomplete="off">

<label>Senha</label>

<input 
type="password" 
name="senha" 
placeholder="Digite sua senha"
required
class="campo"
autocomplete="off">

<button type="submit">
Entrar
</button>

<br><br>

<a href="recuperar.php">
Esqueci minha senha
<br><br>

<a href="cadastro_usuario.php">
Criar Conta
</a>
</a>

</form>

</div>

</div>

</body>
</html>