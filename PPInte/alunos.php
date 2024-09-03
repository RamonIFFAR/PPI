<?php 
    require('config.php');

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    $sql = "select * from aluno";
    $res = $conn->query($sql) or die($conn->error);
    $qtd = $res->num_rows;

    $Cheq = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Cheq);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE</title>
</head>
<body>
    <span>Bem vindo</span>
    <button onclick="location.href='painel.php?sair=1'" name='sair'>sair</button> <br>
    <?php 
        similar_text($UsoC->tipo, "DE", $percent);
        if($qtdChecagem > 0 and $percent == 100){
            print "<br> <a href='criar_aluno.php'>Criar aluno</a> <br>";
        }
        while($row = $res->fetch_object()){
            print "<br> <a href='aluno.php?id=" . $row->matricula . "'>". $row->nome ."</a>";
            // print "<br>" . "<button onclick=\" location.href='professor.php?id_prof=". $alu->matricula ."'\">". "Ver informações" ." </button>";
                
        };
    ?>
</body>
</html>