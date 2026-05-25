<?php

include("conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

$cliente = mysqli_fetch_assoc($resultado);

if(isset($_POST['nome'])){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    $sql_update = "UPDATE clientes SET

    nome='$nome',
    telefone='$telefone',
    email='$email',
    endereco='$endereco'

    WHERE id=$id";

    if(mysqli_query($conexao, $sql_update)){

        header("Location: clientes.php");

    }else{

        echo "Erro ao atualizar.";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>

<body>

<h1>Editar Cliente</h1>

<form method="POST">

<label>Nome:</label><br>
<input type="text" name="nome"
value="<?php echo $cliente['nome']; ?>"><br><br>

<label>Telefone:</label><br>
<input type="text" name="telefone"
value="<?php echo $cliente['telefone']; ?>"><br><br>

<label>Email:</label><br>
<input type="email" name="email"
value="<?php echo $cliente['email']; ?>"><br><br>

<label>Endereço:</label><br>
<input type="text" name="endereco"
value="<?php echo $cliente['endereco']; ?>"><br><br>

<button type="submit">Salvar</button>

</form>

</body>
</html>