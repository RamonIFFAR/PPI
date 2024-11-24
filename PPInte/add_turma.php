<?php
    require('config.php');

    // Inicia a sessão
    session_start();

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

    function addTurma($numero, $sala, $descricao, $curso){
        include('config.php');
        $sql = "insert into turma(nome, sala, descricao, id_curso) values('{$numero}', '{$sala}', '{$descricao}', '{$curso}')";
        $conn->query($sql) or die($conn->error);
        echo "<script>alert('Turma cadastrada com sucesso')</script>";
        echo "<script>location.href='turmas.php'</script>";
    }

    if(isset($_POST['adicionar'])){
        echo 'chegou';
        echo $_POST['numero'];
        echo $_POST['sala'];
        echo $_POST['descricao'];
        echo $_POST['curso'];
        addTurma($_POST['numero'], $_POST['sala'], $_POST['descricao'], $_POST['curso']);
    }

    $sqlC = "select id_curso, nome from curso";
    $resC = $conn->query($sqlC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE: Adicionar Turma</title>
</head>
<body>
    <form method='POST' action='add_turma.php'>
        <label>Número:</label> <br>
        <input type='number' name='numero'> <br> <br>
        <label>Sala</label> <br>
        <input type='number' name='sala'> <br> <br>
        <label>Descrição</label> <br>
        <textarea name='descricao' rows='10' cols='30'></textarea> <br>
        <select id="c" name="curso">
            <?php 
                while($rowC = $resC->fetch_object()){
                    echo "<option value='". $rowC->id_curso ."'>". $rowC->nome ."</option>";
                }
            ?>
        </select> <br><br>
        <button type='submit' name='adicionar'>Salvar</button>
    </form>
</body>
</html>