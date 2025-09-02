<?php
    require('config.php');

    // Inicia a sessão
    session_start();

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

    // Seleciona a turma
    $sqlTurma = "select * from turma";
    $resTurma = $conn->query($sqlTurma);

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

    function adDisciplina($nome, $descricao, $turma){
        include('config.php');
        $sql = "insert into disciplina(nome, descricao) values('{$nome}', '{$descricao}')";
        $conn->query($sql) or die($conn->error);
        $last_id = $conn->insert_id;
        $sql2 = "insert into disciplina_turma(id_disc, id_turma) values('{$last_id}', '{$turma}')";
        $conn->query($sql2) or die($conn->error);
        echo "<script>alert('Disciplina cadastrada com sucesso!')</script>";
        echo "<script>location.href='disciplinas.php'</script>";
    }

    if(isset($_POST['adicionar'])){
        adDisciplina($_POST['nome'], $_POST['descricao'], $_POST['turma']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Disciplinas</title>
</head>
<body>
    <form method='POST' action='add_disciplina.php'>
        <label>Nome</label> <br>
        <input type='text' name='nome'><br> <br>
        <label>Descricao</label> <br>
        <textarea name='descricao' rows='10' cols='30'></textarea> <br> <br>
        <select id='tur' name='turma'>
                <option value='none' selected>--------</option>
                    <?php 
                        while($rowTurma = $resTurma->fetch_object()){
                            echo "<option value='" . $rowTurma->id . "'>" . $rowTurma->nome . "</option>";
                        }
                    ?>
        </select>
        <button type='submit' name='adicionar'>Salvar</button>
    </form>
</body>
</html>