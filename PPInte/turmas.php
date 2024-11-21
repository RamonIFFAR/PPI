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

    // Confere se o usuário é um professor
    $Cprof = "select * from professor where id_prof = '{$_SESSION['id_us']}'";
    $resProf = $conn->query($Cprof);
    $rowProf = $resProf->fetch_object();
    $qtdProf = $resProf->num_rows;

    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    $sqlTurmaADM = "select * from turma";
    $res = $conn->query($sqlTurmaADM) or die($conn->error);

    $sqlTurmaProf = "select id, nome from turma where id = any (select id_turma from professor_turma where id_prof = '{$_SESSION['id_us']}')";
    $resTurmaProf = $conn->query($sqlTurmaProf);
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Turmas</title>
</head>
<body>
    <a href="painel.php">Voltar para o início</a><br> <br>
    <?php 
        //  XXXXXXXXXX If que confere se o usuário é um setor DE XXXXXXXXXXXXXX
        if($qtdChecagem > 0){
            while($row = $res->fetch_object()){
                echo "Turma ".$row->nome."<a href='turma.php?id=". $row->id ."'> Informações</a><br>";
            }
        } else if($qtdProf > 0){
            while($rowTurmaProf = $resTurmaProf->fetch_object()){
                echo "Turma".$rowTurmaProf->nome." <a href='turma.php?id=". $rowTurmaProf->id ."'> Informações</a><br>";
            }
        }
        
    ?>
</body>
</html>
