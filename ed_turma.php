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
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="ed_turmacss.css">
</head>
<body class="Fundo">
    <div class="Background1"></div>

    <form action="ed_turma.php" method="POST" enctype="multipart/form-data">
        <h1> Informações Turma</h1>
        <form action='turma.php' method='POST'>
            <input type='hidden' name='id_turma' value='<?php echo $id_turma?>'>
            <div class="NomeTurma">
                <label>Número:</label> <br>
                <input type='number' name='nome' value='<?php echo $row->nome?>'> <br>
            </div>

            <div class="Sala">
                <label>Sala:</label> <br>
                <input type='number' name='sala' value='<?php echo $row->sala?>'> <br>
            </div>

            <div class="Descricao">
                <label>Descrição:</label> <br>
                <textarea name='descricao' rows='10' cols='30'><?php echo $row->descricao?></textarea><br>
            </div>

            <div class="Posicao">
                <button type="submit" name="editar">Salvar</button>
            </div>
                            
            <a href="turma.php?id=<?php echo $id_turma ?>">Cancelar</a>
        </div>
    </div>
</body>
</html>