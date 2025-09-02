<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    // Finaliza a sessão
    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $id_disc = $_REQUEST['id_disc'];

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

    $sql = "select * from disciplina where id = '{$id_disc}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: disciplina</title>
</head>
<body>
    <button onclick="location.href='disciplinas.php'">Voltar</button> <br><br>
    <a href='DTurmas.php?id_disc=<?php echo $id_disc?>'>Ver turmas com essa disciplina</a> <br> <br>
    <?php
        if($qtdChecagem > 0){
            ?>
            <button onclick="location.href='ed_disciplina.php?id_disc=<?php echo $id_disc?>'">Editar disciplina</button> <br>
            <button onclick="location.href='ed_disciplina.php?id_disc=<?php echo $id_disc?>&excluir=1'">Excluir disciplina</button> <br> <br>
            <?php
            echo $row->nome."<br><br>";
            echo $row->descricao."<br><br>";
        } 
        else {
        echo $row->nome."<br><br>";
        echo $row->descricao."<br><br>";
        }
    ?>
</body>
</html>