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

    function CriarCurso($nome, $duracao, $descricao){
        require('config.php');
        if (empty($_POST) || empty($_POST['nome']) || empty($_POST['duracao']) || empty($_POST['descricao'])){
            echo "É preciso preencher todos os campos para adicionar um novo curso";
        } else {
            $sql = "insert into curso(duracao, descricao, nome) values ('{$duracao}', '{$descricao}', '{$nome}')";
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
            CriarCurso($_POST['nome'], $_POST['duracao'], $_POST['descricao']);
        }
    ?>
    <form action="criar_curso.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome" value="<?php echo @$_POST['nome']?>"> <br>
        <label>Duração</label>
        <input type="text" name="duracao" value="<?php echo @$_POST['duracao']?>"> <br>
        <label>Descrição</label>
        <input type="text" name="descricao" value="<?php echo @$_POST['descricao']?>"> <br>
        <button type="submit" name="cadastro">Criar curso</button>
    </form>

</body>
</html>
<?php 
    } else {
        print "<script>location.href='index.php'; alert('Você precisa estar logado como um setor para acessar essa págia')";
    }
?>