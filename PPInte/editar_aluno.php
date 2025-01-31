<?php 
    require('config.php');

    session_start();

    $aluno = $_REQUEST['id'];


    // XXXXXXXXXX Confere se o usuário está logado XXXXXXXXXXXXXX
    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    // Usado para conferir o tipo do setor
    $Checagem = "select * from setor where id_set = '{$_SESSION['id_us']}'";
    $ConsultaC = $conn->query($Checagem);
    $UsoC = $ConsultaC->fetch_object();
    $qtdChecagem = $ConsultaC->num_rows;






    // Função usada para excluir aluno
    if(isset($_REQUEST['excluir'])){

        $busca = "select * from aluno where matricula = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário excluiu o aluno de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $removercomentarioaluno = "DELETE FROM comentario WHERE matricula = '{$aluno}'";
        $removeralunosql = "DELETE FROM aluno WHERE matricula = '{$aluno}'";
        $conn->query($removercomentarioaluno);
        $conn->query($removeralunosql);
        print "<script>location.href='alunos.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }


    // Seleciona coisas do aluno
    $sql = "select * from aluno where matricula = '{$aluno}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_assoc();

    // Seleciona comentários
    $sqlComentario = "select * from comentario inner join usuario where comentario.id_us = usuario.id_us and matricula = '{$aluno}'";
    $resComentario = $conn->query($sqlComentario);
    $ComentInfo = $res->fetch_assoc();




    function Atualizar($id, $matricula, $telefone, $email, $nome, $genero, $cidade, $dataNasc, $moradia, $cota, $bolsa, $orientador, $reprovacao, $equipTI, $estagio, $cpf, $acompanhamento){
        include('config.php');

        $busca = "select * from aluno where matricula = '{$id}'";
        $hoje = date('Y-m-d');
        $pegaC = $conn->query($busca);
        $mostra = $pegaC->fetch_object();
        $sqlH = "Insert into historico (id_us, descricao) values ('{$_SESSION['id_us']}', 'Usuário realizou uma alteração no aluno de nome ".$mostra->nome."', '". $hoje ."')";
        $conn->query($sqlH) or die($conn->error);

        $sql = "UPDATE aluno SET matricula='{$matricula}', telefone='{$telefone}', email='{$email}', nome='{$nome}', genero='{$genero}', cidade='{$cidade}', dataNasc='{$dataNasc}', moradia='{$moradia}', cota='{$cota}', bolsa='{$bolsa}', orientador='{$orientador}', reprovacao='{$reprovacao}', equipTI='{$equipTI}', estagio='{$estagio}', cpf='{$cpf}', acompanhamento='{$acompanhamento}' where matricula = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='alunos.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="editar_alunocss.css?v=<?php echo time(); ?>">
</head>
<body class="Fundo">

    <div class="Background1"></div>
        <form action="editar_aluno.php" method="POST" enctype="multipart/form-data">
        <h1> Informações Aluno(a)</h1>
            <?php 
                if(isset($_POST['atualizar'])){
                    Atualizar($_POST['id'], $_POST['matricula'], $_POST['telefone'], $_POST['email'], $_POST['nome'], $_POST['genero'], $_POST['cidade'], $_POST['dataNasc'], $_POST['moradia'], $_POST['cota'], $_POST['bolsa'], $_POST['orientador'], $_POST['reprovacao'], $_POST['equipTI'], $_POST['estagio'], $_POST['cpf'], $_POST['acompanhamento']);
                }
                if ($qtdChecagem > 0) {
                    similar_text($UsoC->tipo, "DE", $percent);
                    if($percent  == 100) {

            ?>
            <form action='editar_aluno.php' method='POST'>
                <input type='hidden' name='id' value="<?php echo $aluno ?>">

                <div class="Matricula">
                    <label>Matrícula:</label> <br>
                    <input type='text' name='matricula' value="<?php echo $aluno ?>"></a>
                </div>

                <div class="Telefone">
                    <label>Telefone:</label> <br>
                    <input type='text' name='telefone' value="<?php echo $resSet['telefone'] ?>"></a>
                </div>

                    <div class="Email">
                        <label>Email:</label> <br>
                        <input type='email' name='email' value="<?php echo $resSet['email'] ?>"></a>
                    </div>

                    <div class="Nome">
                        <label>Nome:</label> <br>
                        <input type='text' name='nome' value="<?php echo $resSet['nome'] ?>"></a>
                    </div>

                    <div class="Genero">
                        <label>Gênero:</label> <br>
                        <input type='text' name='genero' value="<?php echo $resSet['genero'] ?>"></a>
                    </div>

                    <div class="Cidade">
                        <label>Cidade:</label> <br>
                        <input type='text' name='cidade' value="<?php echo $resSet['cidade'] ?>"></a>
                    </div>

                    <div class="Data-De-Nascimento">
                        <label>Data de Nascimento:</label> <br>
                        <input type='date' name='dataNasc'value="<?php echo $resSet['dataNasc'] ?>"></a>
                    </div>

                    <div class="Moradia">
                        <label>Moradia:</label> <br>
                        <input type='text' name='moradia' value="<?php echo $resSet['moradia'] ?>"></a>
                    </div>
                            
                    <div class="Cota">
                        <label>Cota:</label> <br>
                        <input type='text' name='cota' value="<?php echo $resSet['cota'] ?>"></a>
                    </div>

                    <div class="Bolsa">
                        <label>Bolsa:</label> <br>
                        <input type='text' name='bolsa' value="<?php echo $resSet['bolsa'] ?>"></a>
                    </div>

                    <div class="Orientador">
                        <label>Orientador:</label> <br>
                        <input type='text' name='orientador' value="<?php echo $resSet['orientador'] ?>"></a>
                    </div>

                    <div class="Reprovacao">
                        <label>Reprovação:</label> <br>
                        <input type='text' name='reprovacao' value="<?php echo $resSet['reprovacao'] ?>"></a>
                    </div>
                
                    <div class="EquipamentoTI">
                        <label>Equipamento TI:</label> <br>
                        <input type='text' name='equipTI' value="<?php echo $resSet['equipTI'] ?>"></a>
                    </div>

                    <div class="Cidade">
                        <label>Cidade:</label> <br>
                        <input type='text' name='cidade' value="<?php echo $resSet['cidade'] ?>"></a>
                    </div>
                            
                    <div class="Estagio">
                        <label>Estágio:</label> <br>
                        <input type='text' name='estagio' value="<?php echo $resSet['estagio'] ?>"></a>
                    </div>

                    <div class="CPF">
                        <label>CPF:</label> <br>
                        <input type='text' name='cpf' value="<?php echo $resSet['cpf'] ?>"></a>
                    </div>
                            
                    <div class="Acompanhamento">
                        <label>Acompanhamento:</label> <br>
                        <input type='text' name='acompanhamento' value="<?php echo $resSet['acompanhamento'] ?>"></a> <br>
                    </div>
                    <div class="Posicao">
                        <button type="submit" name="atualizar">Salvar</button>
                    </div>
                    
                    <a href="aluno.php?id=<?php echo $aluno ?>">Cancelar</a>

                    <?php } 
                        }else {
                            print $resSet['matricula'] . "<br>";
                            print $resSet['telefone'] . "<br>";
                            print $resSet['email'] . "<br>";
                            print $resSet['nome'] . "<br>";
                            print $resSet['genero'] . "<br>";
                            print $resSet['cidade'] . "<br>";
                            print $resSet['dataNasc'] . "<br>";
                            print $resSet['moradia'] . "<br>";
                            print $resSet['cota'] . "<br>";
                            print $resSet['bolsa'] . "<br>";
                            print $resSet['orientador'] . "<br>";
                            print $resSet['reprovacao'] . "<br>";
                            print $resSet['equipTI'] . "<br>";
                        }
                    ?>
                </form>
            </div>
        </div>
</body>
</html>