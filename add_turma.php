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
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="add_turmacss.css?v=<?php echo time(); ?>">
</head>
<body class="Fundo">
    <div class="Background1"></div>
        <form method='POST' action='add_turma.php'>
            <h1>Adicionar turma</h1>
            <div class="Nome">
                <label>Número:</label><br>
                <input type='number' name='numero'> <br>
            </div>

            <div class="Sala">
                <label>Sala:</label><br>
                <input type='number' name='sala'> <br>
            </div>

            <div class="Descricao">
                <label>Descrição</label><br>
                <textarea name='descricao' rows='10' cols='30'></textarea> <br>

            </div>
            <div class="Escolher-Turma">
            <label>Curso:</label> <br>
            <select id="c" name="curso">
                <?php 
                    while($rowC = $resC->fetch_object()){
                        echo "<option value='". $rowC->id_curso ."'>". $rowC->nome ."</option>";
                    }
                ?>
            </select> <br><br>
            </div>
            <button type="submit" name="adicionar">Adicionar Turma</button>
            <a href="turmas.php">Cancelar</a>
        </form>
    </div>
</body>
</html>