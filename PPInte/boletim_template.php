<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $turma = $_REQUEST['id_turma'];

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

    

    $Baluno = "select matricula, aluno.nome from aluno inner join turma on aluno.id_turma = turma.id where turma.id = '{$turma}'";
    $Bres = $conn->query($Baluno);
    
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        };

        .break {
            break-before: always;
            color: red;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        while($Brow = $Bres->fetch_object()){
            echo "Aluno: ".$Brow->nome." Matricula: ".$Brow->matricula;     
            $sql = "select * from disciplina inner join avaliacao on avaliacao.id_disc = disciplina.id inner join frequencia on frequencia.disciplina = disciplina.id where frequencia.matricula = '{$Brow->matricula}' and frequencia.matricula = avaliacao.id_aluno; ";
            $res = $conn->query($sql) or die($conn->error);
    ?>
    <div style="page-break-after:always">
    <table style="width: 100%">
        <tr>
            <th style="width: 70%">Disciplina</th>
            <th>Nota</th>
            <th>Faltas</th>
        </tr>
        <?php 
            
            while($row = $res->fetch_object()){
                echo "<tr>";
                echo "<td>".$row->nome."</td>";
                echo "<td>".$row->NOTA1."</td>";
                echo "<td> ".$row->faltas." </td>";
                echo "</tr>";
            }  
            echo "</table>";
            echo "</div>";
        }
        ?>
</body>
</html>