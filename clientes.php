<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

include("conexao.php");

if(isset($_POST['nome'])){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    $sql = "INSERT INTO clientes(nome, telefone, email, endereco)
            VALUES('$nome', '$telefone', '$email', '$endereco')";

    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Cliente cadastrado com sucesso!')</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="menu">
    <a href="index.php">Início</a>
    <a href="clientes.php">Clientes</a>
    <a href="extintores.php">Extintores</a>
    <a href="listar_extintores.php">Lista</a>
</div>

<div class="container">

    <div>

        <h1>Cadastro de Clientes</h1>

        <form method="POST">

            <label>Nome:</label>
            <input 
            type="text" 
            name="nome" 
            required 
            class="campo"
            autocomplete="off">

            <label>Telefone:</label>
            <input 
            type="text" 
            name="telefone" 
            required 
            class="campo"
            autocomplete="off">

            <label>Email:</label>
            <input 
            type="email" 
            name="email" 
            required 
            class="campo"
            autocomplete="off">

            <label>Endereço:</label>
            <input 
            type="text" 
            name="endereco" 
            required 
            class="campo"
            autocomplete="off">

            <button type="submit">Cadastrar</button>
            <a href="index.php" class="btn btn-dark w-100 mt-3">

🏠 Voltar ao Início

</a>

        </form>

    </div>

    <div class="lista-clientes">

        <h2>Clientes Cadastrados</h2>

        <table>

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>

            <?php

            $sql_clientes = "SELECT * FROM clientes";
            $resultado = mysqli_query($conexao, $sql_clientes);

            while($cliente = mysqli_fetch_assoc($resultado)){

            ?>

            <tr>

                <td><?php echo $cliente['id']; ?></td>

                <td><?php echo $cliente['nome']; ?></td>

                <td><?php echo $cliente['telefone']; ?></td>

                <td><?php echo $cliente['email']; ?></td>

                <td><?php echo $cliente['endereco']; ?></td>

                <td>

                    <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">
                        Editar
                    </a>

                    |

                    <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>">
                        Excluir
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>