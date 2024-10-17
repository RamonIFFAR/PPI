<?php 
    require('config.php');

    session_start();


    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    $sql = "select * from aluno";
    $res = $conn->query($sql) or die($conn->error);
    $qtd = $res->num_rows;

    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    function CadastrarAluno($matricula, $telefone, $email, $nome, $genero, $cidade, $dataNasc, $moradia, $cota, $bolsa, $orientador, $reprovacao, $equipTI, $estagio, $cpf, $acompanhamento){
        require("config.php");
        if(empty($_POST) || (empty($_POST["matricula"])) || empty($_POST["telefone"]) || empty($_POST["email"]) || empty($_POST["nome"]) || empty($_POST["genero"]) || empty($_POST["cidade"]) || empty($_POST["dataNasc"]) || empty($_POST["moradia"]) || empty($_POST["cota"]) || empty($_POST["cpf"])){
            echo "É necessário preencher todos os campos para adicionar um novo professor";
        } else {
            $sql = "INSERT INTO aluno (matricula, telefone, email, nome, genero, cidade, dataNasc, moradia, cota, bolsa, orientador, reprovacao, equipTI, estagio, cpf, acompanhamento) VALUES('{$matricula}','{$telefone}','{$email}','{$nome}','{$genero}','{$cidade}','{$dataNasc}','{$moradia}','{$cota}','{$bolsa}','{$orientador}','{$reprovacao}','{$equipTI}', '{$estagio}','{$cpf}','{$acompanhamento}')";
            $conn->query($sql) or die($conn->error);
            echo "sucesso";
            print "<script> location.href='alunos.php'</script>";
        };
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="criaraluno.css">
    <title>SGAE</title>
</head>
<body class="Fundo">
    <?php
        if(isset($_POST["cadastro"])){
            CadastrarAluno($_POST['matricula'], $_POST['telefone'], $_POST['email'], $_POST['nome'], $_POST['genero'], $_POST['cidade'], $_POST['dataNasc'], $_POST['moradia'], $_POST['cota'], $_POST['bolsa'], $_POST['orientador'], $_POST['reprovacao'], $_POST['equipTI'], $_POST['estagio'], $_POST['cpf'], $_POST['acompanhamento']);
        }
    ?>

    <div class="Background1"></div>
    <form action="criar_aluno.php" method="POST">
    <h1>Adicionar Aluno</h1>

        <label>Matrícula</label>
        <input type="text" name="matricula" value="<?php echo @$_POST['matricula']?>"> <br>
        
        
        
        <label>Telefone</label>
        <input type="text" name="telefone" value="<?php echo @$_POST['telefone']?>"> <br>
        
        
        
        <label>Email</label>
        <input type="email" name="email" value="<?php echo @$_POST['email']?>"> <br>
        
        
        
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        
        
        
        <label>Gênero</label>
        <input type="text" name="genero" value="<?php echo @$_POST['genero']?>"> <br>
        
        
        
        <label>Cidade</label>
        <input type="text" name="cidade" value="<?php echo @$_POST['cidade']?>"> <br>
        
        
        
        <label>Data de Nascimento</label>
        <input type="text" name="dataNasc" value="<?php echo @$_POST['dataNasc']?>"> <br>
        
        
        
        <label>Moradia</label>
        <input type="text" name="moradia" value="<?php echo @$_POST['moradia']?>"> <br>
        
        
        
        <label>Cota</label>
        <input type="text" name="cota" value="<?php echo @$_POST['cota']?>"> <br>
        
        
        
        <label>Bolsa</label>
        <input type="text" name="bolsa" value="<?php echo @$_POST['bolsa']?>"> <br>
        
        
        
        <label>Orientador</label>
        <input type="text" name="orientador" value="<?php echo @$_POST['orientador']?>"> <br>
        
        
        
        <label>Reprovação</label>
        <input type="text" name="reprovacao" value="<?php echo @$_POST['reprovacao']?>"> <br>
        

        
        <label>Equipamento TI</label>
        <input type="text" name="equipTI" value="<?php echo @$_POST['equipTI']?>"> <br>
        

        
        <label>Estágio</label>
        <input type="text" name="estagio" value="<?php echo @$_POST['estagio']?>"> <br>
        
        
        
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php echo @$_POST['cpf']?>"> <br>
        
        
        
        <label>Acompanhamento</label>
        <input type="text" name="acompanhamento" value="<?php echo @$_POST['acompanhamento']?>"> <br>
        
        <button type="submit" name="cadastro">Cadastrar</button>
        <a href="alunos.php">Cancelar</a>
    </form>
</body>
</html>