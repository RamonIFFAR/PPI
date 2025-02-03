<?php 
    require("config.php");

    session_start();

    if(isset($_POST['adicionarL'])){
        adicionarLembrete($_POST['nome'], $_POST['desc'], $_POST['dt'], $_SESSION['id_us'], $_POST['rec'], $_POST['plan'], $_POST['rel']);
    }

    function adicionarLembrete($nome, $desc, $dt, $id, $rec, $plan, $rel){
        include('config.php');
        $SQLad = "insert into lembrete(nome, descricao, dt, id_us, limite_relatorio, limite_plano, limite_recuperacao) values('{$nome}', '{$desc}', '{$dt}', '{$id}', '{$rel}', '{$plan}', '{$rec}')";
        $conn->query($SQLad) or die($conn->error);
        echo "<script>alert('Lembrete cadastrado com sucesso')</script>";
        echo "<script>location.href='lembretes.php'</script>";
    }

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    $sql = "select * from usuario inner join setor where usuario.senha = '{$_SESSION["senha"]}' and setor.id_set = '{$_SESSION["id_us"]}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();
    $qtd = $res->num_rows;

    if($qtd < 0){
        echo "<script>location.href='painel.php'</script>";
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Adicionar Lembrete</title>
</head>
<body>
    <form method='POST' action='add_lembrete.php'>
        <label>Nome</label> <br>
        <input type='text' name='nome'> <br><br>
        <label>Descrição</label> <br>
        <input type='text' name='desc'> <br><br>
        <label>Data</label> <br>
        <input type='date' name='dt'> <br><br>
        <?php 
            $sqlRel = "select * from lembrete where limite_relatorio = 1";
            $resRel = $conn->query($sqlRel);
            $qtdRel = $resRel->num_rows;

            $sqlRec = "select * from lembrete where limite_recuperacao = 1";
            $resRec = $conn->query($sqlRec);
            $qtdRec = $resRec->num_rows;

            $sqlP = "select * from lembrete where limite_plano = 1";
            $resP = $conn->query($sqlP);
            $qtdP = $resP->num_rows;

            if ($qtdRel == 0){
                echo "<input type='checkbox' name='rel' value='1'>
            <label for='rel'>Limite para envio do relatório de atividade</label> <br>";
            } else {
                echo "<input type='hidden' name='rel' value='0'>";
            };
            if ($qtdRec == 0){
                echo "<input type='checkbox' name='rec' value='1'>
            <label for='rec'>Limite para envio das recuperações paralelas</label> <br>";
            } else {
                echo "<input type='hidden' name='rec' value='0'>";
            };
            if($qtdP == 0){
                echo "<input type='checkbox' name='plan' value='1'>
            <label for='plan'>Limite para envio do plano de trabalho</label> <br>";
            } else {
                echo "<input type='hidden' name='plan' value='0'>";
            };
        ?>
        <button type='submit' name='adicionarL'>Adicionar lembrete</button>
    </form>
</body>
</html>