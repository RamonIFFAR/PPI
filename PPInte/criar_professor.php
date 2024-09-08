<?php
session_start();
require("config.php");

function CadastrarProfessor($conn, $cpf, $Siape, $email, $nome, $senha, $foto){
    // Utilizar consultas preparadas para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO usuario (cpf, Siape, email, nome, senha, foto) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $cpf, $Siape, $email, $nome, $senha, $foto);
    
    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $stmt2 = $conn->prepare("INSERT INTO PROFESSOR (id_prof) VALUES (?)");
        $stmt2->bind_param("i", $last_id);
        $stmt2->execute();
        echo "Sucesso";
        echo "<script>location.href='professores.php'</script>";
    } else {
        die($conn->error);
    }
}

if (isset($_POST["cadastro"])) {
    if (!empty($_FILES['foto']['name'])) {
        $nomeFoto = $_FILES['foto']['name'];
        $tipo = $_FILES['foto']['type'];
        $nomeTemporario = $_FILES['foto']['tmp_name'];
        $tamanho = $_FILES['foto']['size'];
        $erros = array();  

        $tamanhoMax = 1024 * 1024 * 50;

        if ($tamanho > $tamanhoMax) {
            $erros[] = "Tamanho do arquivo excedido";
        }

        $arquivosPermitidos = ["png", "jpeg", "jpg"];
        $extensao = pathinfo($nomeFoto, PATHINFO_EXTENSION);
        if (!in_array($extensao, $arquivosPermitidos)) {
            $erros[] = "Arquivo inválido";
        }

        $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
        if (!in_array($tipo, $tiposPermitidos)) {
            $erros[] = "Tipo de arquivo inválido";
        }

        if (!empty($erros)) {
            foreach ($erros as $erro) {
                echo $erro;
            }
        } else {
            $caminho = "fotos/";
            $hoje = date("d-m-Y");
            $novoNome = $hoje . "-" . $nomeFoto;
            if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
                echo 'Upload com sucesso';
                CadastrarProfessor($conn, $_POST['cpf'], $_POST['Siape'], $_POST['email'], $_POST['nome'], $_POST['senha'], $caminho . $novoNome);
            } else {
                echo "Falha no upload";
            }
        }
    }
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
