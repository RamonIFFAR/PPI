<?php
    require('config.php');

    session_start();

    //variáveis para a checagem se o usuário é um setor

    $prof = $_REQUEST['id_prof'];
    
    if(isset($_REQUEST['excluir'])){

        $busca = "select * from usuario where id_us = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao, dat) values ('{$_SESSION['id_us']}', 'Usuário excluiu o professor de nome ".$mostra->nome."', '". $hoje ."')";
        $QHist = $conn->query($sqlH) or die($conn->error);

        $removerprofessorsql = "DELETE FROM professor WHERE id_prof = '{$prof}'";
        $removerusuariosql = "DELETE FROM usuario WHERE id_prof = '{$prof}'";
        $conn->query($removerprofessorsql);
        $conn->query($removerusuariosql);
        //print "<script>location.href='professores.php'</script>";
    }

    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;

    function Atualizar($id, $cpf, $Siape, $nome, $fone){
        include('config.php');

        $busca = "select * from usuario where id_us = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou uma alteração no professor de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $sql = "UPDATE usuario SET cpf = '{$cpf}', Siape = '{$Siape}', nome = '{$nome}', fone='{$fone}' where id_us = '{$id}'";
        $conn->query($sql) or die($conn->error);
        //print "<script> location.href='professores.php'</script>";
    }
    // Variáveis para a conferência do usuário
    $sql = "select * from usuario where id_us = '{$prof}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

    if ($qtdChecagem > 0) {
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
        <link rel="stylesheet" href="editarcss.css">
    </head>

    <body class="Fundo">

        <div class="Background1"></div>

        <form action="editar.php" method="POST" enctype="multipart/form-data">
            <h1> Informações Professor(a)</h1>
            <?php
                if(isset($_POST['atualiza'])){
                    Atualizar($_POST['id_prof'], $_POST['cpf'], $_POST['siape'], $_POST['nome'], $_POST['fone']);
                }
                similar_text($UsoC->tipo, "DE", $percent);
                if($percent  == 100) { ?>
                    <form action='professor.php' method='POST'>

                    <div class="NomeCompleto">
                        <label>Nome:</label> <br>
                        <input type='text' name='nome' value="<?php echo $resSet->nome ?>"> <br>
                        <input type='hidden' name='id_prof' value="<?php echo $prof ?>"> <br>
                    </div>

                    <div class="CPF">
                        <label>CPF:</label> <br>
                        <input type='text' name='cpf' value="<?php echo $resSet->cpf ?>"><br>
                    </div>

                    <div class="MatriculaSiape">
                        <label>Matrícula SIAPE:</label> <br>
                        <input type='text' name='siape' value="<?php echo $resSet->Siape ?> "></a><br>
                    </div>

                    <div class="Fone">
                        <label>Número de Telefone:</label> <br>
                        <input type='text' name='fone' value="<?php echo $resSet->fone ?> "></a><br>
                    </div>

                    <div class="Posicao">
                        <button type="submit" name="atualiza">Salvar</button>
                    </div>
                    
                    <a href="professor.php?id_prof=<?php echo $prof ?>">Cancelar</a>

                

                <?php } else {
                    print $resSet->nome . "<br>";
                    print $resSet->Siape . "<br>";
                    print $resSet->email . "<br>";
                    print $resSet->cpf . "<br>";
                    }
                } else {
                    print "<script>location.href='index.php'</script>";
                }
            ?>
        </form>
    </body>
</html>