<?php 
    require('config.php');

    session_start();


    $Checagem = "select * from usuario where senha = '{$_SESSION['senha']}' and email= '{$_SESSION['email']}'";
    $QChecagem = $conn->query($Checagem);
    $tes = $QChecagem->fetch_object();
    $procura = $QChecagem->num_rows; 

    $sql = "select * from aluno";
    $res = $conn->query($sql) or die($conn->error);
    $qtd = $res->num_rows;

    // Seleciona a turma
    $sqlTurma = "select * from turma";
    $resTurma = $conn->query($sqlTurma);

    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    function CadastrarAluno($matricula, $telefone, $email, $nome, $genero, $cidade, $dataNasc, $moradia, $cota, $bolsa, $orientador, $reprovacao, $equipTI, $estagio, $cpf, $acompanhamento, $turma, $foto){
        require("config.php");
        if(empty($_POST) || (empty($_POST["matricula"])) || empty($_POST["telefone"]) || empty($_POST["email"]) || empty($_POST["nome"]) || empty($_POST["genero"]) || empty($_POST["cidade"]) || empty($_POST["dataNasc"]) || empty($_POST["moradia"]) || empty($_POST["cota"]) || empty($_POST["cpf"]) || empty($_POST['turma'])){
            echo "É necessário preencher todos os campos para adicionar um novo aluno";
        } else if($turma == 'none'){
            $sql = "INSERT INTO aluno (matricula, telefone, email, nome, genero, cidade, dataNasc, moradia, cota, bolsa, orientador, reprovacao, equipTI, estagio, cpf, acompanhamento, foto) VALUES('{$matricula}','{$telefone}','{$email}','{$nome}','{$genero}','{$cidade}','{$dataNasc}','{$moradia}','{$cota}','{$bolsa}','{$orientador}','{$reprovacao}','{$equipTI}', '{$estagio}','{$cpf}','{$acompanhamento}', '{$foto}')";
            $conn->query($sql) or die($conn->error);
            echo "sucesso";
            print "<script> location.href='alunos.php'</script>";
        } else {
            $sql = "INSERT INTO aluno (matricula, telefone, email, nome, genero, cidade, dataNasc, moradia, cota, bolsa, orientador, reprovacao, equipTI, estagio, cpf, acompanhamento, id_turma, foto) VALUES('{$matricula}','{$telefone}','{$email}','{$nome}','{$genero}','{$cidade}','{$dataNasc}','{$moradia}','{$cota}','{$bolsa}','{$orientador}','{$reprovacao}','{$equipTI}', '{$estagio}','{$cpf}','{$acompanhamento}','{$turma}', '{$foto}')";
            $conn->query($sql) or die($conn->error);
            echo "sucesso";
            print "<script> location.href='alunos.php'</script>";
        };
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="criar_alunocss.css?v=<?php echo time(); ?>">
</head>
<body class="Fundo">

    <div class="Background1"></div>
        <?php
            if(isset($_POST["cadastro"])){
                if(isset($_POST['cadastro'])){
                    if (!empty($_FILES['foto']['name'])){
                        $nomeFoto = $_FILES['foto']['name'];
                        $tipo = $_FILES['foto']['type'];
                        $nomeTemporario = $_FILES['foto']['tmp_name'];
                        $tamanho = $_FILES['foto']['size'];
                        $erros = array();  
            
                        $tamanhoMax = 1024 * 1024 * 50;
            
                        if($tamanho > $tamanhoMax){
                            $erros[] = "Tamanho do arquivo excedido";
                        }
            
                        $arquivosPermitidos = ["png", "jpeg", "jpg"];
                        $extensao = pathinfo($nomeFoto, PATHINFO_EXTENSION);
                        if (!in_array($extensao, $arquivosPermitidos)){
                            $erros[] = "Arquivo inválido";
                        }
            
                        $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
                        if (!in_array($tipo, $tiposPermitidos)){
                            $erros[] = "Tipo de arquivo inválido";
                        }
            
                        if (!empty($erros)) {
                            foreach ($erros as $erro){
                                echo $erro;
                            }
                        } else {
                            $caminho = "fotos/";
                            $hoje = date("d-m-Y");
                            $novoNome = $hoje."-".$nomeFoto;
                            if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                                echo 'Upload com sucesso';
                                CadastrarAluno($_POST['matricula'], $_POST['telefone'], $_POST['email'], $_POST['nome'], $_POST['genero'], $_POST['cidade'], $_POST['dataNasc'], $_POST['moradia'], $_POST['cota'], $_POST['bolsa'], $_POST['orientador'], $_POST['reprovacao'], $_POST['equipTI'], $_POST['estagio'], $_POST['cpf'], $_POST['acompanhamento'], $_POST['turma'], $caminho.$novoNome);
                            } else {
                                echo "Falha no upload";
                            }
                        }
                    } else {
                        echo "Nenhum arquivo foi selecionado";
                    }
                }
                
            }
        ?>
        <form action="criar_aluno.php" method="POST" enctype="multipart/form-data">
        <h1> Informações Aluno(a)</h1>
            <form action='criar_aluno.php' method='POST' enctype="multipart/form-data">
                <div class="Matricula">
                    <label>Matrícula:</label> <br>
                    <input type='text' name='matricula' value="<?php echo @$_POST['matricula']?>"></a>
                </div>

                <div class="Telefone">
                    <label>Telefone:</label> <br>
                    <input type='text' name='telefone' value="<?php echo @$_POST['telefone']?>"></a>
                </div>

                    <div class="Email">
                        <label>Email:</label> <br>
                        <input type='email' name='email' value="<?php echo @$_POST['email']?>"></a>
                    </div>

                    <div class="Nome">
                        <label>Nome:</label> <br>
                        <input type='text' name='nome' value="<?php echo @$_POST['nome']?>"></a>
                    </div>

                    <div class="Genero">
                        <label>Gênero:</label> <br>
                        <input type='text' name='genero' value="<?php echo @$_POST['genero']?>"></a>
                    </div>

                    <div class="Cidade">
                        <label>Cidade:</label> <br>
                        <input type='text' name='cidade' value="<?php echo @$_POST['cidade']?>"></a>
                    </div>

                    <div class="Data-De-Nascimento">
                        <label>Data de Nascimento:</label> <br>
                        <input type='date' name='dataNasc'value="<?php echo @$_POST['dataNasc']?>"></a>
                    </div>

                    <div class="Moradia">
                        <label>Moradia:</label> <br>
                        <input type='text' name='moradia' value="<?php echo @$_POST['moradia']?>"></a>
                    </div>
                            
                    <div class="Cota">
                        <label>Cota:</label> <br>
                        <input type='text' name='cota' value="<?php echo @$_POST['cota']?>"></a>
                    </div>

                    <div class="Bolsa">
                        <label>Bolsa:</label> <br>
                        <input type='text' name='bolsa' value="<?php echo @$_POST['bolsa']?>"></a>
                    </div>

                    <div class="Orientador">
                        <label>Orientador:</label> <br>
                        <input type='text' name='orientador' value="<?php echo @$_POST['orientador']?>"></a>
                    </div>

                    <div class="Reprovacao">
                        <label>Reprovação:</label> <br>
                        <input type='text' name='reprovacao' value="<?php echo @$_POST['reprovacao']?>"></a>
                    </div>
                
                    <div class="EquipamentoTI">
                        <label>Equipamento TI:</label> <br>
                        <input type='text' name='equipTI' value="<?php echo @$_POST['equipTI']?>"></a>
                    </div>
                            
                    <div class="Estagio">
                        <label>Estágio:</label> <br>
                        <input type='text' name='estagio' value="<?php echo @$_POST['estagio']?>"></a>
                    </div>

                    <div class="CPF">
                        <label>CPF:</label> <br>
                        <input type='text' name='cpf' value="<?php echo @$_POST['cpf']?>"></a>
                    </div>
                            
                    <div class="Acompanhamento">
                        <label>Acompanhamento:</label> <br>
                        <input type='text' name='acompanhamento' value="<?php echo @$_POST['acompanhamento']?>"></a> <br>
                    </div>
                    <div class="Foto">
                    <label for="foto">Insira uma foto:</label>
                        <label for="foto" class="custom-file-upload">
                            <img src="Imagens/Foto.png" alt="Escolher arquivo"> <!-- Imagem que funciona como botão -->
                        </label>
                        <input id="foto" type="file" name="foto" style="display: none;"> <!-- Campo de input escondido -->
                    </div>
                    <div class="Posicao">
                        <button type="submit" name="cadastro">Salvar</button>
                    </div>

                    <div class='Select'>
                        <select id='tur' name='turma'>
                        <option value='none' selected>Turma</option>
                            <?php 
                                while($rowTurma = $resTurma->fetch_object()){
                                    echo "<option value='" . $rowTurma->id . "'>" . $rowTurma->nome . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <a href="alunos.php">Cancelar</a>
                </form>
            </div>
        </div>
</body>
</html>
