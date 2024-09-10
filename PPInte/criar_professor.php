<?php
    session_start();

    function CadastrarProfessor($cpf, $Siape, $email, $nome, $senha, $foto, $fone){
        require("config.php");
        if(empty($_POST) || (empty($_POST["cpf"])) || empty($_POST["Siape"]) || empty($_POST["email"]) || empty($_POST["nome"]) || empty($_POST["senha"]) || empty($_POST["fone"])){
            echo "É necessário preencher todos os campos para adicionar um novo professor";
        } else {
            $sql = "insert into usuario (cpf, Siape, email, nome, senha, foto, fone) values ('{$cpf}', '{$Siape}', '{$email}', '{$nome}', '{$senha}', '{$foto}', '{$fone}')";
            $sql2 = "INSERT INTO PROFESSOR(id_prof) VALUES(LAST_INSERT_ID())";
            $conn->query($sql) or die($conn->error);
            $conn->query($sql2) or die($conn->error);
            echo "sucesso";
            print "<script> location.href='professores.php'</script>";
        };
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link rel="stylesheet" href="criarprofcss.css">
</head>
<body class="Fundo">
    <?php
        if(isset($_POST["cadastro"])){
            if (! empty($_FILES['foto']['name'])){
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
                if ( ! in_array($extensao, $arquivosPermitidos)){
                    $erros[] = "Arquivo inválido";
                }

                $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
                if ( ! in_array($tipo, $tiposPermitidos)){
                    $erros[] = "Tipo de arquivo inválido";
                }

                if (! empty($erros)) {
                    foreach ($erros as $erro){
                        echo $erro;
                    }
                } else {
                    $caminho = "fotos/";
                    $hoje = date("d-m-Y");
                    $novoNome = $hoje."-".$nomeFoto;
                    if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                        echo 'upload com sucesso';
                        CadastrarProfessor($_POST['cpf'], $_POST['Siape'], $_POST['email'], $_POST['nome'], $_POST['senha'], $caminho.$novoNome, $_POST['fone']);
                    }else {
                        echo "faha no upload";
                    }
                }

            }
        }
    ?>
    <div class="Background1"></div>
    
    <form action="criar_professor.php" method="POST" enctype="multipart/form-data">
        <h1> Adicionar Professor(a)</h1>

        <div class="NomeCompleto">
            <label>Insira o nome completo:</label> <br>
            <input type="text" name="nome" value="<?php echo htmlspecialchars(@$_POST['nome'], ENT_QUOTES); ?>"> <br>
        </div>

        <div class="MatriculaSiape">
            <label>Insira a matrícula SIAPE:</label> <br>
            <input type="text" name="Siape" value="<?php echo htmlspecialchars(@$_POST['Siape'], ENT_QUOTES); ?>"> <br>
        </div>

        <div class="EmailInsti">
            <label>Insira o email institucional:</label> <br>
            <input type="email" name="email" value="<?php echo htmlspecialchars(@$_POST['email'], ENT_QUOTES); ?>"> <br>
        </div>

        <div class="CPF">
            <label>Insira o CPF:</label> <br>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars(@$_POST['cpf'], ENT_QUOTES); ?>"> <br>
         </div>
        
         <div class="Senha">
            <label>Insira uma senha:</label> <br>
            <input type="text" name="senha" value="<?php echo htmlspecialchars(@$_POST['senha'], ENT_QUOTES); ?>"> <br>
        </div>

        <div class="Fone">
            <label>Insira o número de telefone:</label> <br>
            <input type="text" name="fone" value="<?php echo htmlspecialchars(@$_POST['fone'], ENT_QUOTES); ?>"> <br>
        </div>

        <button type="submit" name="cadastro">Cadastrar</button>

        <a href="professores.php">Cancelar</a>
        
        <div class="Foto">
            <label for="foto">Insira uma foto:</label>
            <label for="foto" class="custom-file-upload">
                <img src="Imagens/Foto.png" alt="Escolher arquivo"> <!-- Imagem que funciona como botão -->
            </label>
            <input type="file" id="foto" name="foto">
        </div>

    </form>
</body>
</html>
