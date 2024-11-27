<?php 
    require("config.php");

    session_start();

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "select * from usuario where senha = '{$_SESSION["senha"]}' and email = '{$_SESSION["email"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    $sqlSET = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}' and tipo like 'DE'";
    $resSET = $conn->query($sqlSET) or die($conn->error);
    $rowSET = $resSET->fetch_object();
    $qtdSET = $resSET->num_rows;

    if($qtd < 0){
        echo "<script>location.href='painel.php'</script>";
    }

    $sqlLembrete = "select * from lembrete";
    $Lres = $conn->query($sqlLembrete) or die($conn->error);
    $Lqtd = $Lres->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Lembretes</title>
</head>
<body>
    
    <?php 
    if($qtdSET > 0){
        echo "<a href='add_lembrete.php'>Adicionar lembrete</a> <br>";
    }
        if($Lqtd > 0){
            while($Lrow = $Lres->fetch_object()){
                echo "<br>" . $Lrow->nome . "<br>";
                echo $Lrow->descricao . "<br>";
                echo $Lrow->dt . "<br>"; ?>
                <button onclick="location.href='lembrete.php?id_lemb=<?php echo $Lrow->id ?>'">Visualizar lembrete</button> <br>
                <?php 
                if ($qtdSET > 0 || $Lrow->id_us == $_SESSION['id_us']){
                    ?>
                    <button onclick="if(confirm('Tem certeza que deseja apagar esse lembrete? Uma fez feita, essa ação não pode ser desfeita')){location.href='lembretes.php?id_lemb=<?php echo $Lrow->id ?>&excluir=1'}">Excluir lembrete</button> <br>
                    <?php
                }
            }
        }
    ?>
    
</body>
</html>
