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

    $sql = "select * from disciplina";
    $res = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Disciplinas</title>
</head>
<body>
    <button onclick="location.href='painel.php'">Voltar</button> <br><br>
    <?php 
        if($qtdChecagem > 0){
            echo "<a href='add_disciplina.php'>Criar disciplina</a> <br> <br>";
        }
        while($row = $res->fetch_object()){
            echo $row->nome . " <a href='disciplina.php?id_disc=" . $row->id . "'>ver mais</a><br> <br>";
        }
    ?>
</body>
</html>