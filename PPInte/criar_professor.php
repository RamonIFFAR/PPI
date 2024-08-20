<?php
    session_start();

    function CadastrarProfessor($cpf, $Siape, $email, $nome, $senha){
        require("config.php");
        if(empty($_POST) || (empty($_POST["cpf"])) || empty($_POST["Siape"]) || empty($_POST["email"]) || empty($_POST["nome"]) || empty($_POST["senha"])){
            echo "É necessário preencher todos os campos para adicionar um novo professor";
        } else {
            $sql = "insert into usuario (cpf, Siape, email, nome, senha) values ('{$cpf}', '{$Siape}', '{$email}', '{$nome}', '{$senha}')";
            $sql2 = "INSERT INTO PROFESSOR(id_prof) VALUES(LAST_INSERT_ID())";
            $conn->query($sql) or die($conn->error);
            $conn->query($sql2) or die($conn->error);
            echo "sucesso";
            print "<script> location.href='professores.php'</script>";
        };
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar professor</title>
</head>
<body>
    <?php
        if(isset($_POST["cadastro"])){
            CadastrarProfessor($_POST['cpf'], $_POST['Siape'], $_POST['email'], $_POST['nome'], $_POST['senha'],);
        }
    ?>
    <form action="criar_professor.php" method="POST">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php echo @$_POST['cpf']?>"> <br>
        <label>Siape</label>
        <input type="text" name="Siape" value="<?php echo @$_POST['Siape']?>"> <br>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo @$_POST['email']?>"> <br>
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        <label>Senha</label>
        <input type="text" name="senha" value="<?php echo @$_POST['senha']?>"> <br>
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>