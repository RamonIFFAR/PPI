<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    // XXXXXXXXXX Confere se o usuário está logado XXXXXXXXXXXXXX
    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    // Usado para conferir se o setor é da DE
    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}' and tipo like 'DE'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;


    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    //  XXXXXXXXXX If que confere se o usuário é um setor DE XXXXXXXXXXXXXX
    if($qtdChecagem > 0){

    } else{
    }

    // Busca as turmas favoritas do usuário
    $sql = "select turma.nome, favorita.id_turma from favorita inner join turma on turma.id = favorita.id_turma where favorita.id_us = '{$_SESSION['id_us']}'";
    $res = $conn->query($sql);
    $qtd = $res->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Turmas Favoritas</title>
</head>
<body>
    <h1>Turmas favoritas</h1><br><br>
    <button onClick="location.href='painel.php'">Voltar</button><br>
    <?php
        while($row = $res->fetch_object()){
            echo "<span>Turma ". $row->nome ."</span> <a href='turma.php?id=". $row->id_turma ."'>Ver mais</a>";
        }
    ?>
    
</body>
</html>