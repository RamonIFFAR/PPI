<?php 
    require("config.php");

    session_start();

    $id = $_REQUEST['id_lemb'];

    if(isset($_REQUEST['sair'])){
        session_destroy();
        print "<script>location.href='index.php'</script>";
        
    }

    if(isset($_POST['editar'])){
        editarLembrete($_POST['id'], $_POST['nome'], $_POST['desc'], $_POST['dt']);
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

    if($Lrow->id_us == $_SESSION['id_us']){

    } else{
        echo "<script>alert('Você não tem permissão para acessar essa página')</script>";
        echo "<script>location.href='lembretes.php'</script>";
    }

    function editarLembrete($id, $nome, $desc, $dt){
        include('config.php');
        $SQLat = "update lembrete set nome = '{$nome}', descricao = '{$desc}', dt = '{$dt}' where id = '{$id}'";
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
        <input type='hidden' name='id' value='<?php echo $Lrow->id ?>'>
        <label>Nome</label>
        <input type='text' name='nome' value='<?php echo $Lrow->nome ?>'>
        <label>Descrição</label>
        <input type='text' name='desc' value='<?php echo $Lrow->descricao ?>'>
        <label>Data</label>
        <input type='date' name='dt' value='<?php echo $Lrow->dt ?>'>
        <button type='submit' name='editar'>Editar lembrete</button>
    </form>
</body>
</html>