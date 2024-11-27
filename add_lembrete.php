<?php 
    require("config.php");

    session_start();

    if(isset($_POST['adicionarL'])){
        adicionarLembrete($_POST['nome'], $_POST['desc'], $_POST['dt'], $_SESSION['id_us']);
    }

    function adicionarLembrete($nome, $desc, $dt, $id){
        include('config.php');
        $SQLad = "insert into lembrete(nome, descricao, dt, id_us) values('{$nome}', '{$desc}', '{$dt}', '{$id}')";
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
        <button type='submit' name='adicionarL'>Adicionar lembrete</button>
    </form>
</body>
</html>