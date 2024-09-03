<?php 
    require('config.php');

    session_start();

    $curso = $_REQUEST['id'];

    
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

    // Função usada para excluir curso
    if(isset($_REQUEST['excluir'])){
        $removercursosql = "DELETE FROM curso WHERE id_curso = '{$curso}'";
        $conn->query($removercursosql);
        print "<script>location.href='painel.php'</script>";
    }
    // XXXXXXXXXX If que confere se o usuário está logado XXXXXXXXXXXXXX
    if($procura > 0){

    } else {
        print"<script>alert('Você precisa estar logado para poder acessar o sistema')</script>";
        print"<script>location.href=index.php</script>";
    }

    function Atualizar($id, $nome, $duracao, $descricao){
        include('config.php');
        $sql = "UPDATE curso SET nome='{$nome}', duracao='{$duracao}', descricao='{$descricao}' where id_curso = '{$id}'";
        $conn->query($sql) or die($conn->error);
        print "<script> location.href='painel.php'</script>";
    }

    $sql = "select * from curso where id_curso = '{$curso}'";
    $res = $conn->query($sql);
    $resSet = $res->fetch_object();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seja bem-vindo, aqui você poderá ver informações relacionadas ao curso</h1>
    <?php 
        if(isset($_POST['atualiza'])){
            Atualizar($_POST['id'], $_POST['nome'], $_POST['duracao'], $_POST['descricao']);
        }
        similar_text($UsoC->tipo, "DE", $percent);
        if($percent  == 100) {
            print   "<form action='curso.php' method='POST'>
                        <input type='hidden' name='id' value='". $curso ."'>
                        <label>Nome</label>
                        <input type='text' name='nome' value=". $resSet->nome ."> <br>
                        <label>Duração</label>
                        <input type='text' name='duracao' value=". $resSet->duracao ."> <br>
                        <label>Descrição</label>
                        <input type='text' name='descricao' value=". $resSet->descricao ."> <br>
                        <button type='submit' name='atualiza'>Salvar</button>
                    </form>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir esse curso?')){location.href='curso.php?id=" . $curso ."&excluir=1';}else{false;} \">Excluir</button>"
                    ;
        } else {
                print $resSet->nome . "<br>";
                print $resSet->duracao . "<br>";
                print $resSet->descricao . "<br>";
    }
?>
</body>
</html>