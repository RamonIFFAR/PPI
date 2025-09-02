<?php
    require('config.php');

    // Inicia a sessão
    session_start();

    $id_turma = $_REQUEST['id_turma'];

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

    //  XXXXXXXXXX If que confere se o usuário é um setor DE XXXXXXXXXXXXXX
    if($qtdChecagem > 0){

    } else{
        print"<script>alert('Você não tem permissão para estar aqui')</script>";
        print"<script>location.href=index.php</script>";
    }

    $sql = "select * from turma where id = '{$id_turma}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

    function edTurma($id_turma, $nome, $sala, $descricao){
        include('config.php');

        $busca = "select * from turma where id = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou uma alteração na turma de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $sqlat = "update turma set nome = '{$nome}', sala = '{$sala}', descricao = '{$descricao}' where id= '{$id_turma}'";
        $conn->query($sqlat) or die($conn->error);
        echo "<script>alert('Turma editada com sucesso')</script>";
        echo "<script>location.href='turmas.php'</script>";
    }

    if(isset($_POST['editar'])){
        edTurma($_POST['id_turma'], $_POST['nome'], $_POST['sala'], $_POST['descricao']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: editando turma</title>
</head>
<body>
    <form method='POST' action='ed_turma.php'>
        <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
        <label>Número:</label> <br>
        <input type='number' name='nome' value='<?php echo $row->nome?>'> <br> <br>
        <label>Sala</label> <br>
        <input type='number' name='sala' value='<?php echo $row->sala?>'> <br> <br>
        <label>Descrição</label> <br>
        <textarea name='descricao' rows='10' cols='30'><?php echo $row->descricao?></textarea> <br> <br>
        <button type='submit' name='editar'>Salvar</button>
    </form>
</body>
</html>