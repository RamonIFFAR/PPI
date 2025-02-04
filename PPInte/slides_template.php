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

    

    $Baluno = "select *, turma.nome as turma from aluno inner join turma on aluno.id_turma = turma.id where turma.id = '{$turma}'";
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

        img {
            width:200px; /* you can use % */
            height: auto;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        while($Brow = $Bres->fetch_object()){
            $sqlN = "select NOTA1, NOTA2, disciplina.nome as disciplina from avaliacao inner join disciplina on avaliacao.id_disc = disciplina.id where id_aluno = '{$Brow->matricula}'";
            $resN = $conn->query($sqlN) or die($conn->error);
            $rowN = $resN->fetch_object();
            $qtdN = $resN->num_rows;

            echo "Aluno: ".$Brow->nome ."<br>";
            echo "Matrícula: ".$Brow->matricula ."<br>";
            echo "Telefone: ".$Brow->telefone ."<br>";
            echo "Email: ".$Brow->email ."<br>";
            echo "Gênero: ".$Brow->genero ."<br>";
            echo "Cidade: ".$Brow->cidade ."<br>";
            echo "Data de nascimento: ".$Brow->dataNasc ."<br>";
            echo "Moradia: ".$Brow->moradia ."<br>";
            echo "Cota: ".$Brow->cota ."<br>";
            echo "Bolsa: ".$Brow->bolsa ."<br>";
            echo "Orientador da mostra científica: ".$Brow->orientador ."<br>";
            echo "Reprovações: ".$Brow->reprovacao ."<br>";
            echo "Equipamento da TI emprestado: ".$Brow->equipTI ."<br>";
            echo "Estágio: ".$Brow->estagio ."<br>";
            echo "Acompanhamento: ".$Brow->acompanhamento ."<br>";
            echo "Turma: ".$Brow->turma ."<br>";
            if ($qtdN > 0){
                if ($rowN->NOTA1 < 6){
                    echo "Nota do primeiro semestre de ".$rowN->disciplina.": ".$rowN->NOTA1."<br>";
                }
                if ($rowN->NOTA1 < 7){
                    echo "Nota do segundo semestre de ".$rowN->disciplina.": ".$rowN->NOTA2."<br>";
                }
                }
            echo "<img src='".$Brow->foto."'> <br>";
        
    ?>
    <div style="page-break-after:always">
    </div>
    <?php 
    }
    ?>
</body>
</html>