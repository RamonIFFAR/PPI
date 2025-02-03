<?php 
    require("config.php");

    session_start();

    $id = $_REQUEST['id_lemb'];

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    if(isset($_POST['editar'])){
        if (!isset($_POST['rel'])){
            $_POST['rel'] = 0;
        }
        if (!isset($_POST['rec'])){
            $_POST['rec'] = 0;
        }
        if (!isset($_POST['plan'])){
            $_POST['plan'] = 0;
        }
        editarLembrete($_POST['id'], $_POST['nome'], $_POST['desc'], $_POST['dt'], $_POST['rel'], $_POST['rec'], $_POST['plan']);
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

    $sqlLembrete = "select * from lembrete where id='{$id}'";
    $Lres = $conn->query($sqlLembrete) or die($conn->error);
    $Lrow = $Lres->fetch_object();
    $Lqtd = $Lres->num_rows;

    if($Lrow->id_us == $_SESSION['id_us'] or $qtdSET > 0){

    } else{
        echo "<script>alert('Você não tem permissão para acessar essa página')</script>";
        echo "<script>location.href='lembretes.php'</script>";
    }

    function editarLembrete($id, $nome, $desc, $dt, $rec, $plan, $rel){
        include('config.php');
        $SQLat = "update lembrete set nome = '{$nome}', descricao = '{$desc}', dt = '{$dt}', limite_recuperacao = '{$rec}', limite_plano = '{$plan}', limite_relatorio = '{$rel}' where id = '{$id}'";
        $conn->query($SQLat) or die($conn->error);
        echo "<script>alert('Lembrete atualizado com sucesso')</script>";
       echo "<script>location.href='lembretes.php'</script>";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Editar lembrete</title>
</head>
<body>
    <form method='POST' action='lembrete.php'>
        <input type='hidden' name='id' value='<?php echo $Lrow->id ?>'><br>
        <label>Nome</label><br>
        <input type='text' name='nome' value='<?php echo $Lrow->nome ?>'><br>
        <label>Descrição</label><br>
        <input type='text' name='desc' value='<?php echo $Lrow->descricao ?>'><br>
        <label>Data</label><br>
        <input type='date' name='dt' value='<?php echo $Lrow->dt ?>'> <br>

        <?php 
            $sqlRel = "select * from lembrete where limite_relatorio = 1 and id = '{$id}'";
            $sqlRel2 = "select * from lembrete where limite_relatorio = 1";
            $resRel2 = $conn->query($sqlRel2);
            $qtdRel2 = $resRel2->num_rows;
            $resRel = $conn->query($sqlRel);
            $qtdRel = $resRel->num_rows;

            $sqlRec = "select * from lembrete where limite_recuperacao = 1 and id = '{$id}'";
            $sqlRec2 = "select * from lembrete where limite_recuperacao = 1";
            $resRec2 = $conn->query($sqlRec2);
            $qtdRec2 = $resRec2->num_rows;
            $resRec = $conn->query($sqlRec);
            $qtdRec = $resRec->num_rows;

            $sqlP = "select * from lembrete where limite_plano = 1 and id = '{$id}'";
            $sqlP2 = "select * from lembrete where limite_plano = 1";
            $resP2 = $conn->query($sqlP2);
            $qtdP2 = $resP2->num_rows;
            $resP = $conn->query($sqlP);
            $qtdP = $resP->num_rows;

            if ($qtdRel > 0){
                echo "<input type='checkbox' name='rel' value='1' checked>
            <label for='rel'>Limite para envio do relatório de atividade</label> <br>";
            } else if ($qtdRel2 > 0){
                echo "<input type='hidden' name='rel' value='0'>";
            } else {
                echo "<input type='checkbox' name='rel' value='1'>
            <label for='rel'>Limite para envio do relatório de atividade</label> <br>";
            };

            if ($qtdRec > 0){
                echo "<input type='checkbox' name='rec' value='1' checked>
            <label for='rec'>Limite para envio das recuperações paralelas</label> <br>";
            } else if ($qtdRec2 > 0){
                echo "<input type='hidden' name='rec' value='0'>";
            } else {
                echo "<input type='checkbox' name='rec' value='1'>
            <label for='rec'>Limite para envio das recuperações paralelas</label> <br>";
            };

            if($qtdP > 0){
                echo "<input type='checkbox' name='plan' value='1' checked>
            <label for='plan'>Limite para envio do plano de trabalho</label> <br>";
            } else if ($qtdP2 > 0) {
                echo "<input type='hidden' name='plan' value='0'>";
            } else {
                echo "<input type='checkbox' name='plan' value='1'>
            <label for='plan'>Limite para envio do plano de trabalho</label> <br>";
            };

        ?>
        <button type='submit' name='editar'>Adicionar lembrete</button>
    </form>
</body>
</html>