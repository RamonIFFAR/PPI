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

    if(isset($_REQUEST['excluir'])){
        exDisciplina($id_disc);
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

    $sql = "select * from disciplina where id = '{$id_disc}'";
    $res = $conn->query($sql);
    $row = $res->fetch_object();

    function edDisciplina($id, $nome, $descricao){
        include('config.php');

        $busca = "select * from disciplina where id = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou uma alteração na disciplina de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $sqlat = "update disciplina set nome = '{$nome}', descricao = '{$descricao}' where id = '{$id}'";
        $conn->query($sqlat) or die($conn->error);
        echo "<script>alert('Disciplina atualizada com sucesso!')</script>";
        echo "<script>location.href='disciplinas.php'</script>";
    }

    function exDisciplina($id){
        include('config.php');

        $busca = "select * from disciplina where id = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou a exclusão da disciplina de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $sqlrm = "delete from disciplina where id ='{$id}'";
        $conn->query($sqlrm) or die($conn->error);
        echo "<script>alert('Disciplina removida com sucesso!')</script>";
        echo "<script>location.href='disciplinas.php'</script>";
    }

    if(isset($_REQUEST['editar'])){
        edDisciplina($_POST['id_disc'], $_POST['nome'], $_POST['descricao']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Disciplina</title>
</head>
<body>
    <form method="POST" action='ed_disciplina.php'>
        <input type='hidden' name='id_disc' value='<?php echo $id_disc ?>'>
        <label>Nome</label>
        <input type='text' name='nome' value='<?php echo $row->nome ?>'>
        <label>Descrição</label>
        <input type='text' name='descricao' value='<?php echo $row->descricao ?>'>
        <button type='submit' name='editar'>Salvar</button>
    </form>
</body>
</html>