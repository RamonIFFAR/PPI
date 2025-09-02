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

    

    $Baluno = "select *, aluno.nome as aluno, turma.nome as turma from aluno inner join turma on aluno.id_turma = turma.id where turma.id = '{$turma}'";
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

        .Image2 {
            width: 200px;
            position: absolute;
            left: 80%;
            top: 60%;
            height: 200px;
            border: 5px solid black;
        }

        .Image {
            position: absolute;
            left: 80%;
            top: 0%;
            width: 200px;
        }

        .Separar p{
            font-size: 20px;
            font-style: Arial, sans-serif;
            margin-bottom: -29px;
        }

        .BarraVerde {
            position: absolute;
            width: 1300px;
            height: 20px;
            left: -50px;
            top: 735px;
            background-color: Green;
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
        while($Brow = $Bres->fetch_object()){
            echo "<div class='Position' style='page-break-after:always'>";
            $sqlN = "select NOTA1, NOTA2, disciplina.nome as disciplina from avaliacao inner join disciplina on avaliacao.id_disc = disciplina.id where id_aluno = '{$Brow->matricula}'";
            $resN = $conn->query($sqlN) or die($conn->error);
            $rowN = $resN->fetch_object();
            $qtdN = $resN->num_rows;
            
            
            echo "<img class='Image' src='Imagens\LogoIffar.png'>";
            echo "<div class='Separar'>";
            echo "<p><b>Aluno:</b> ".$Brow->aluno ."</p><br>";
            echo "<p><b>Matrícula:</b> ".$Brow->matricula ."</p><br>";
            echo "<p><b>Telefone: </b>".$Brow->telefone ."</p><br>";
            echo "<p><b>Email: </b>".$Brow->email ."</p><br>";
            echo "<p><b>Gênero: </b>".$Brow->genero ."</p><br>";
            echo "<p><b>Cidade: </b>".$Brow->cidade ."</p><br>";
            echo "<p><b>Data de nascimento: </b>".$Brow->dataNasc ."</p><br>";
            echo "<p><b>Moradia: </b>".$Brow->moradia ."</p><br>";
            echo "<p><b>Cota: </b>".$Brow->cota ."</p><br>";
            echo "<p><b>Bolsa: </b>".$Brow->bolsa ."</p><br>";
            echo "<p><b>Orientador da mostra científica: </b>".$Brow->orientador ."</p><br>";
            echo "<p><b>Reprovações: </b>".$Brow->reprovacao ."</p><br>";
            echo "<p><b>Equipamento da TI emprestado: </b>".$Brow->equipTI ."</p><br>";
            echo "<p><b>Estágio: </b>".$Brow->estagio ."</p><br>";
            echo "<p><b>Acompanhamento: </b>".$Brow->acompanhamento . "</p><br>";
            echo "<p><b>Turma: </b>".$Brow->turma ."</p><br>";
            if ($qtdN > 0){
                if ($rowN->NOTA1 < 6){
                    echo "<p><b>Nota do primeiro semestre de".$rowN->disciplina."</b>: ".$rowN->NOTA1."</p><br>";
                }
                if ($rowN->NOTA1 < 7){
                    echo "<p><b>Nota do segundo semestre de".$rowN->disciplina."</b>: ".$rowN->NOTA2."</p><br>";
                }
                }
            echo "</div>";
            echo "<img class='Image2' src='".$Brow->foto."'> <br>";
            echo "<div class='BarraVerde'></div>";
            echo "</div>";
        }
        
    ?>
    
    
</body>
</html>