<?php

include("conexao.php");

$mensagem = "";

if(isset($_POST['nome'])){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios
    (nome, telefone, email, usuario, senha)

    VALUES

    ('$nome', '$telefone', '$email',
    '$usuario', '$senha')";

    if(mysqli_query($conexao, $sql)){

        $mensagem = "Usuário cadastrado com sucesso!";

    }else{

        $mensagem = "Erro ao cadastrar!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Cadastro de Usuário</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="login-box">

<h1>Criar Conta</h1>

<form method="POST">

<label>Nome Completo</label>

<input
type="text"
name="nome"
required
class="campo"
autocomplete="off">

<label>Telefone</label>

<input
type="text"
name="telefone"
required
class="campo"
autocomplete="off">

<label>E-mail</label>

<input
type="email"
name="email"
required
class="campo"
autocomplete="off">

<label>Usuário</label>

<input
type="text"
name="usuario"
required
class="campo"
autocomplete="off">

<label>Senha</label>

<input
type="password"
name="senha"
required
class="campo"
autocomplete="off">

<button type="submit">
Cadastrar Usuário
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