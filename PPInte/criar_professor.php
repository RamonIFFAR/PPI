<?php
    session_start();

    function CadastrarProfessor($cpf, $Siape, $email, $nome, $senha, $foto){
        require("config.php");
        if(empty($_POST) || (empty($_POST["cpf"])) || empty($_POST["Siape"]) || empty($_POST["email"]) || empty($_POST["nome"]) || empty($_POST["senha"])){
            echo "É necessário preencher todos os campos para adicionar um novo professor";
        } else {
            $sql = "insert into usuario (cpf, Siape, email, nome, senha, foto) values ('{$cpf}', '{$Siape}', '{$email}', '{$nome}', '{$senha}', '{$foto}')";
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
    <title>Adicionar professor</title>
</head>
<body>
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
                        CadastrarProfessor($_POST['cpf'], $_POST['Siape'], $_POST['email'], $_POST['nome'], $_POST['senha'], $caminho.$novoNome);
                    }else {
                        echo "faha no upload";
                    }
                }

            }
        }
    ?>
    <form action="criar_professor.php" method="POST" enctype="multipart/form-data">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php echo @$_POST['cpf']?>"> <br>
        <label>Siape</label>
        <input type="text" name="Siape" value="<?php echo @$_POST['Siape']?>"> <br>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo @$_POST['email']?>"> <br>
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        <label>Senha</label>
        <input type="text" name="senha" value="<?php echo @$_POST['senha']?>"> <br>
        <lable>Foto</label>
        <input type="file" name="foto" value="<?php echo @$_POST['foto'] ?>">
        <button type="submit" name="cadastro">Cadastrar</button>
    </form>
</body>
</html>