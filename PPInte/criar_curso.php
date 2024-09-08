<?php 
    require('config.php');

    session_start();
    

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

    function CriarCurso($nome, $duracao, $descricao, $foto){
        require('config.php');
        if (empty($_POST) || empty($_POST['nome']) || empty($_POST['duracao']) || empty($_POST['descricao'])){
            echo "É preciso preencher todos os campos para adicionar um novo curso";
        } else {
            $sql = "insert into curso(duracao, descricao, nome, foto) values ('{$duracao}', '{$descricao}', '{$nome}', '{$foto}')";
            $conn->query($sql) or die($conn->error);
            echo "sucesso";
            echo "<script>location.href='painel.php'</script>";
        }
    };

    if ($procura > 0 and $qtdChecagem > 0) {
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGAE</title>
</head>
<body>
    <h1>Adicionar curso</h1>
    <?php 
        if(isset($_POST['cadastro'])){
            echo "chegou post <br>";
            if (! empty($_FILES['foto']['name'])){
                echo "chegou checagem arquivo <br>";
                $nomeFoto = $_FILES['foto']['name'];
                $tipo = $_FILES['foto']['type'];
                $nomeTemporario = $_FILES['foto']['tmp_name'];
                $tamanho = $_FILES['foto']['size'];
                $erros = array();  

                $tamanhoMax = 1024 * 1024 * 50;

                if($tamanho > $tamanhoMax){
                    $erros[] = "Tamanho do arquivo excedido";
                    echo "chegou checagem tamanho";
                }

                $arquivosPermitidos = ["png", "jpeg", "jpg"];
                $extensao = pathinfo($nomeFoto, PATHINFO_EXTENSION);
                if ( ! in_array($extensao, $arquivosPermitidos)){
                    $erros[] = "Arquivo inválido";
                    echo "chegou checagem formato";
                }

                $tiposPermitidos = ["image/png", "image/jpeg", "image/jpg"];
                if ( ! in_array($tipo, $tiposPermitidos)){
                    $erros[] = "Tipo de arquivo inválido";
                    echo "chegou checagem tipo";
                }

                if (! empty($erros)) {
                    foreach ($erros as $erro){
                        echo $erro;
                    }
                } else {
                    echo "chegou checagem erros";
                    $caminho = "fotos/";
                    $hoje = date("d-m-Y");
                    $novoNome = $hoje."-".$nomeFoto;
                    if(move_uploaded_file($nomeTemporario, $caminho.$novoNome)) {
                        echo 'upload com sucesso';
                        CriarCurso($_POST['nome'], $_POST['duracao'], $_POST['descricao'], $caminho.$novoNome);
                    }else {
                        echo "faha no upload";
                    }
                }
            } else {
                echo "falhou";
            }
        }
    ?>
    <form action="criar_curso.php" method="POST" enctype="multipart/form-data">
        <label>Nome</label><br>
        <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        <label>Duração</label><br>
        <input type="text" name="duracao" value="<?php echo @$_POST['duracao']?>"> <br>
        <label>Descrição</label><br>
        <input type="text" name="descricao" value="<?php echo @$_POST['descricao']?>"> <br>
        <label>Foto</label><br>
        <input type="file" name="foto" value="<?php echo @$_POST['foto']?>"> <br>
        <button type="submit" name="cadastro">Criar curso</button>
    </form>

</body>
</html>
<?php 
    } else {
        print "<script>location.href='index.php'; alert('Você precisa estar logado como um setor para acessar essa págia')";
    }
?>