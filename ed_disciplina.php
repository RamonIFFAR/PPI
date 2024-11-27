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
        $sqlat = "update disciplina set nome = '{$nome}', descricao = '{$descricao}' where id = '{$id}'";
        $conn->query($sqlat) or die($conn->error);
        echo "<script>alert('Disciplina atualizada com sucesso!')</script>";
        echo "<script>location.href='disciplinas.php'</script>";
    }

    function exDisciplina($id){
        include('config.php');
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
        <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
        <link rel="stylesheet" href="ed_disciplinacss.css">
</head>
<body class="Fundo">
    <div class="Background1"></div>
    <form action="ed_disciplina.php" method="POST" enctype="multipart/form-data">
        <h1> Informações Disciplina</h1>
        <form action='disciplina.php' method='POST'>
            <input type='hidden' name='id_disc' value=" <?php echo $id_disc?>"> <br>
            <div class="NomeCompleto">
                <label>Nome:</label> <br>
                <input type='text' name='nome' value=" <?php echo $row->nome ?>"><br>
            </div>

            <div class="descricao">
                <label>Descrição:</label> <br>
                <textarea name='descricao' rows='10' cols='30'><?php echo $row->descricao?></textarea><br> <br>
            </div>
            <div class="Posicao">
                <button type="submit" name="editar">Salvar</button>
            </div>          
            <a href="disciplina.php?id_disc=<?php echo $id_disc?>">Cancelar</a>
        </form>
    </form>
</body>
</html>